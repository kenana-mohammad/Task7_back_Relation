<?php

namespace App\Http\Controllers;

use App\Models\phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $phone = phone::with('employee')->get();
        return response()->json([
            'status' =>'success',
            'phone' =>$phone,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try
        {
      DB::beginTransaction();
       $phone = phone::create([
        'number' =>$request->number,
        'employee_id' => $request->employee_id,

       ]);
       DB::commit();
         return response()->json([
            'status' => 'Add',
            'phone'=> $phone,
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
    public function show(phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, phone $phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(phone $phone)
    {
        //
    }
}
