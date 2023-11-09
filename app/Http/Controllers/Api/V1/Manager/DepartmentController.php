<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DepInterface;



class DepartmentController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    protected $repo;
    function __construct(DepInterface $repo)
    {
        $this->repo = $repo;
    }

    public function store(Request $request)
    {
        $this->repo->store($request);
    }

    public function edit($id)
    {
        return $this->repo->edit($id);

    }

    public function update( Request $request)
    {
        return $this->repo->update($request);
    }


    public function Search(Request $request)
    {
        return $this->repo->Search($request);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }









}
