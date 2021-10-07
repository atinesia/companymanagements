<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.company.index');
    }

    public function jsonData(){
        $companies = Company::latest()->get();
        //dd($companies);
        return DataTables::of($companies)
            ->addIndexColumn()
            ->addColumn('c_logo', function ($company) {
                $url= asset('storage/'.$company->logo);
                return '<img src="'.$url.'" border="0" width="50" class="img-rounded" align="center" />';
            })
            ->addColumn('c_website', function ($company) {
                return '<a target="_blank" href="'.$company->website.'">'.$company->website.'</a>';
            })
            ->addColumn('action', function ($company) {
                //return '<a href="'.route('company.show',['company'=>$company->id]).'"><i class="fa fa-edit"></i></a>';
                return '
                    <a href="#" id="edit-company" data-id="'.$company->id.'"><i class="fa fa-edit"></i></a>
                    <a href="#" class="text-danger" id="delete-company" data-id="'.$company->id.'"><i class="fa fa-trash"></i></a>
                ';
            })->rawColumns(
                [
                    'c_logo', 'action',
                    'c_website','action'
                ]
            )->make(true);
    }

    public function create()
    {
        return view('admin.company.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        if(Request()->hasFile('logo')){
            $path = Request()->file('logo')->store('/images/companylogo','public');
            $company->logo = $path;
        }
        $company->website = $request->website;
        $company->save();

        return redirect(route('company.index'));
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $company = Company::findOrFail($id);
            return response()->json(['result' => $company]);
        }
    }

    public function uploadFile($id){
        if(Request()->hasFile('file')){
            //Request()->file('file')->store('images/companylogo', 'public');

            $path = Request()->file('file')->store('/images/companylogo','public');
            $company = Company::find($id);
            $company->logo = $path;
            $company->save();
        }

    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name'=>'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->save();

        return response()->json(['success' => 'Company Data is successfully updated']);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();

        return response()->json(['success','company has been deleted!']);
    }
}
