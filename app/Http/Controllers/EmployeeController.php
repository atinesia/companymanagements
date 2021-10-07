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
        $employees = Employee::latest()->filters(request()->all());
        $companies =  Company::all();
        return view('admin.employee.index',[
            'employees' => $employees->paginate(5)->withQueryString(),
            'companies' => $companies
        ]);
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
