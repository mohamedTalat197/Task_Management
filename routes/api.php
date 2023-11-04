<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\Auth;
use \App\Http\Controllers\Api\V1\Manager\DepartmentController;
use \App\Http\Controllers\Api\V1\Manager\EmployeeController;
use \App\Http\Controllers\Api\V1\Manager\TaskController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth Routes ...
Route::post('auth/register', Auth\RegisterController::class);
Route::post('auth/login', Auth\LoginController::class);

// Department Routes ...
Route::post('store',[\App\Http\Controllers\Api\v1\Manager\DepartmentController::class, 'store']);
Route::get('/edit/{id}',[\App\Http\Controllers\Api\v1\Manager\DepartmentController::class, 'edit']);
Route::post('/update',[\App\Http\Controllers\Api\v1\Manager\DepartmentController::class, 'update']);
Route::get('/Search',[\App\Http\Controllers\Api\v1\Manager\DepartmentController::class, 'Search']);
Route::post('/delete/{id}',[\App\Http\Controllers\Api\v1\Manager\DepartmentController::class, 'delete']);

// Employee Routes ...
Route::post('store/employee',[\App\Http\Controllers\Api\v1\Manager\EmployeeController::class, 'store']);
Route::get('edit/employee/{id}',[\App\Http\Controllers\Api\v1\Manager\EmployeeController::class, 'edit']);
Route::post('update/employee',[\App\Http\Controllers\Api\v1\Manager\EmployeeController::class, 'update']);
Route::post('/delete/employee/{id}',[\App\Http\Controllers\Api\v1\Manager\EmployeeController::class, 'delete']);

// Task Routes ...
Route::post('store/task',[\App\Http\Controllers\Api\v1\Manager\TaskController::class, 'store'])
->middleware('auth:sanctum');
Route::get('get/task',[\App\Http\Controllers\Api\v1\Manager\TaskController::class, 'get'])
->middleware('auth:sanctum');


