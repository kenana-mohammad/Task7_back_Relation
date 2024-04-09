<?php

namespace App\Http\Controllers;

use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try{
            DB::beginTransaction();
            $service = service::create([
             'name' =>$request->name,
            ]);
            DB::commit();
              return response()->json([
                 'status' => 'Add',
                 'service'=> $service,
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
    public function show(service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, service $service)
    {
        //
        $newData=[];
        if (isset($request->name)){
            $newData['name'] = $request->name;

         }

          $service->update($newData);
          return response()->json([
            'status' =>'update',
            'service' =>$service,

          ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service $service)
    {
        //
        if($service){
            $employee= $service->Employees_services;
            if($employee){
           $service->Employees_services()->detach();
            }
            $service->delete();
        }
        return response()->json([
            'status' =>'delete',

          ]);
    }
}
