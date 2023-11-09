<?php

namespace App\Reposatries;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DepInterface;
use App\Http\Resources\DepartmentResource;


class DepRepo implements DepInterface
{
    use \App\Traits\ApiResponseTrait;

    public function store( $request)
    {
        $request->validate([
            'name' =>'required',
            'descrption' => 'required'
        ]);
        $department = Department::create([
            'name' => $request->name,
            'descrption' => $request->descrption
        ]);
        return $this->apiResponseMessage(1,'تمت الاضافة بنجاح',200);
    }


    public function edit($id)
    {
        $department = Department::findOrfail($id);
        if(!$department){
            return $this->not_found_v2('الداتا غير موجوده');
        }
        else {
            $data = new DepartmentResource($department);
            return $this->apiResponseData($data , $message = null , $code = 200);

        }
    }


    public function update( $request)
    {
        $department = Department::findOrfail($request->id);
        if(!$department){
            return $this->not_found_v2('الداتا غير موجوده');

        }
        else {
            $department->name = $request->name;
            $department->descrption = $request->descrption;
            $department->update();
            $data = new DepartmentResource($department);
            return $this->apiResponseData($data , $message = null , $code = 200);
        }
    }

    public function Search($request)
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
        ->first();
        $data = new DepartmentResource($department);
        return $this->apiResponseData($data , $message = null , $code = 200);
    }


    public function delete($id)
    {
        $department = Department::find($id);
        if($department){
            $department->delete();
        }
        else{
            return $this->apiResponseMessage( 0 ,'القسم غير موجود', );
        }
        return $this->apiResponseMessage( 0 ,'تم مسح القسم', 200);

    }

}
