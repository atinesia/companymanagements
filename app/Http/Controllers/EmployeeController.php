<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.employee.index',['companies' => $companies]);
    }

    public function jsonData(){
        $employees = Employee::with('company')->latest()->get();
        return DataTables::of($employees)
            ->addIndexColumn()
            ->addColumn('company', function ($employee) { 
                return '<a href="#" id="show-company-detail" data-id="'.$employee->company->id.'">'.$employee->company->name.'</a>';
            })
            ->addColumn('action', function ($employee) {
                //return '<a href="'.route('employee.show',['employee'=>$employee->id]).'"><i class="fa fa-edit"></i></a>';
                return '
                    <a href="#" id="edit-employee" data-id="'.$employee->id.'"><i class="fa fa-edit"></i></a>
                    <a href="#" class="text-danger" id="delete-employee" data-id="'.$employee->id.'"><i class="fa fa-trash"></i></a>
                ';
            })->rawColumns(
                [
                    'c_website','action',
                    'company','action'
                ]
            )->make(true);
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.employee.add',['companies' => $companies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firts_name' => 'required',
            'last_name' => 'required'
        ]);

        $employee = new Employee();
        $employee->firts_name = $request->firts_name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        return redirect(route('employee.index'));
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json(['result' => $company]);
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json(['result' => $employee]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $rules = array(
            'firts_name'=>'required',
            'last_name'=>'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $employee = Employee::find($id);
        $employee->firts_name = $request->firts_name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        return response()->json(['success' => 'Employee Data is successfully updated']);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json(['success','employee has been deleted!']);
    }
}
