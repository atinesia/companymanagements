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
        return DataTables::of($companies)
            ->addIndexColumn()
            ->addColumn('c_logo', function ($company) { 
                $url= asset('storage/'.$company->logo);
                return '<img src="'.$url.'" border="0" width="50" class="img-rounded" align="center" />';
            })
            ->addColumn('action', function ($company) {
                //return '<a href="'.route('company.show',['company'=>$company->id]).'"><i class="fa fa-edit"></i></a>';
                return '<a href="#" id="edit-company" data-id="'.$company->id.'"><i class="fa fa-edit"></i></a>';
            })->rawColumns(['c_logo', 'action'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $company = Company::findOrFail($id);
            return response()->json(['result' => $company]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
