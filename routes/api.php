<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//company
Route::apiResource('company',CompanyController::class);
//empolyee
Route::apiResource('employee',EmployeeController::class);


//one to many get empolyee
Route::get('getEmpolyee',[CompanyController::class,'getEmpolyee']);
//phone
Route::apiResource('phone',PhoneController::class);
//service
Route::apiResource('service',ServiceController::class);
