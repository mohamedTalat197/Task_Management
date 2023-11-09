<?php
namespace App\Interfaces;

interface DepInterface
{
    public function store( $request);


    public function edit($id);


    public function update( $request);


    public function Search($request);


    public function delete($id);

}
