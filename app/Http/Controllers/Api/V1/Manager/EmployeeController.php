<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;


class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fname' =>'required|max:255',
            'lname' => 'required|max:255',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'salary' => 'required|not_in:0|numeric',
            'manager_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $fileName);

        $employee = new Employee;
        $employee->fname = $request->input('fname');
        $employee->lname = $request->input('lname');
        $employee->image = $fileName;
        $employee->salary = $request->input('salary');
        $employee->manager_id = $request->input('manager_id');
        $employee->department_id = $request->input('department_id');
        $employee->save();

        return response()->json([
            'success' => true,
            'Message' => 'Employee Added Successfully',
            'Data' => [
            'Employee' => $employee
            ],
        ]);
    }

    public function edit($id)
    {
        $employee = Employee::findOrfail($id);
        if(!$employee){
            return response()->json([
                'Message' => 'Employee Doesnt Exist'
            ]);
        }
        else {
            return response()->json([
                'success' => true,
                'data' => [
                    'Employee' =>$employee
                ],
            ]);
        }
    }



    public function update(Request $request){
         $employee = Employee::findOrfail($request->id);
         if (!$employee) {
             return Response::json(['message' => 'Id not found'], 404);
         }
         $validatedData = Validator::make($request->all(), [
             'fname' =>'required|max:255',
             'lname' => 'required|max:255',
             'image' => 'required|mimes:jpeg,png,jpg,gif',
             'salary' => 'required|not_in:0|numeric',
             'manager_id' => 'required|exists:users,id',
             'department_id' => 'required|exists:departments,id',
         ]);

         if ($validatedData->fails()) {
             return Response::json(['success' => false, 'message' => $validatedData->errors()], 400);
         }

        if ($request->hasFile('image')) {
            $image = $request->image;
            $fileName = date('Y') . $image->getClientOriginalName();
             $request->image->storeAs('image', $fileName, 'public');
             $employee['image'] = $fileName;

             $image->update($request->all());

            return Response::json(['success' => true, 'message' => 'Employee updated successfully!',
            'updated_data' => $employee], 200);
        }
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        if($employee){
            $employee->delete();
        }
        else{
            return response()->json([
                'success' => false,
                'Message' => 'Employee Doesnt Exist'
            ]);
        }
        return response()->json([
            'success' => true,
            'Message' => 'employee Deleted Successfully'
        ]);


    }



}
