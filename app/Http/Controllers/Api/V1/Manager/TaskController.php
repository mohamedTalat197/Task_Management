<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use Auth;



class TaskController extends Controller
{
    public function store(Request $request)
    {
        $userid = Auth::user()->id;
        $employee = Employee::where('manager_id',$userid)->find($request->employee_id);
        if($employee){
            if($task = Task::create([
                'name' => $request->name,
                'descrption' => $request->descrption,
                'employee_id' => $employee->id,
                'manager_id' => $userid,
                'status' => $request->status,
            ])){
                return response()->json([
                    'Status' => true,
                    'Message'=>'Task Added Successfully',
                    'Data' => [
                        'Task' => $task
                    ]
                ]);
               }
            }else{
            return response()->json([
                'Status' => false,
                'Message'=>'Something Wrong',
            ]);
        };
    }

    public function get()
    {
        $userid = Auth::user()->id;
        $task = Task::where('manager_id', $userid )->get();

        if($task){
            return response()->json([
                'Status' => true,
                'Data' => [
                    'Task' =>$task ,
                ]
                ]);
        }
    }
}






