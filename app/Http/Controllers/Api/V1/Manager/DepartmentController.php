<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;


class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'descrption' => 'required'
        ]);
        $department = Department::create([
            'name' => $request->name,
            'descrption' => $request->descrption
        ]);
        return response()->json([
            'success' => true,
            'Message' => 'Department Added Successfully'
        ]);
    }

    public function edit($id)
    {
        $department = Department::findOrfail($id);
        if(!$department){
            return response()->json([
                'Message' => 'Department Doesnt Exist'
            ]);
        }
        else {
            return response()->json([
                'success' => true,
                'data' => [
                    'Department' =>$department
                ],
            ]);
        }
    }

    public function update( Request $request)
    {
        $department = Department::findOrfail($request->id);
        if(!$department){
            return response()->json([
                'Message' => 'Department Doesnt Exist'
            ]);
        }
        else {
            $department->name = $request->name;
            $department->descrption = $request->descrption;
            $department->update();
            return response()->json([
                'success' => true,
                'message' => 'Department Updated Successfuly',
                'data' => [
                    'Department' =>$department
                ],
            ]);
        }
    }


    public function Search(Request $request)
    {
        $department = Department::query()
        ->withCount([
            'employees',
            'employees as Total_Salaries'=> function($query) {
                $query->select(DB::raw('sum(salary)'));
            }
        ])
        ->when($request->name, function($query) use ($request) {
              $query->where('name', $request->name);
        })
        ->get();
        return response()->json([
            'success' => true,
            'data' => [
                'Department' =>$department
            ],
        ]);
    }

    public function delete($id)
    {
        $department = Department::find($id);
        if($department){
            $department->delete();
        }
        else{
            return response()->json([
                'success' => false,
                'Message' => 'Department Doesnt Exist'
            ]);
        }
        return response()->json([
            'success' => true,
            'Message' => 'Department Deleted Successfully'
        ]);


    }









}
