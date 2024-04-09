<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\storeEmpoleeRequest;
use App\Http\Requests\updateCompantRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $empolyees= employee::all();
        return response()->json([
            'status' =>"success",
            'employee' =>$empolyees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeEmpoleeRequest $request)
    {
        //
        $request->validated();
        try{
        DB::beginTransaction();
        $empolyee = employee::create([
         'name' =>$request->name,
         'age' => $request->age,
         'salary' => $request->salary,
         'email' => $request->email,
         'company_id' => $request->company_id,


        ]);
         $empolyee->services()->attach($request->service_id);
        DB::commit();
          return response()->json([
             'status' => 'Add',
             'empolyee'=> $empolyee,
             'services' => $empolyee->services,
          ]);
        }
        catch(\throwable $th){
         DB::rollBack();
         Log::debug($th);
         $e=\Log::error( $th->getMessage());

         return response()->json([
             'status' => 'error'
         ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCompantRequest $request, employee $employee)
    {
        //
        $newData=[];
        if (isset($request->name)){
            $newData['name'] = $request->name;


         }
          if(isset($request->email)){
            $newData['email'] = $request->email;
          }
          if(isset($request->age)){
            $newData['age'] = $request->age;
          }
          if(isset($request->salary)){
            $newData['salary'] = $request->salary;
          }
          if(isset($request->company_id)){
            $newData['company_id'] = $request->company_id;
          }
          $employee->update($newData);
          $employee->services()->sync($request->service_id);

          return response()->json([
            'status' =>'update',
            'employee' =>$employee,
            'services' => $employee->services,

          ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employee $employee)
    {
        //
        if ($employee) {
            $services = $employee->services;

            if ($services) {
                $employee->services()->detach();
            }

            $employee->delete();
        }
        return response()->json([
            'status' => 'delete'
        ]);
    }

}
