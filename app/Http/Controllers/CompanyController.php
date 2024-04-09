<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\updateCompantRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $companies = Company::all();
        return response()->json([
            'status' =>'success list',
            'company' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)

    {
        //
           try
            {
          DB::beginTransaction();
           $company = company::create([
            'name' =>$request->name,
            'address' => $request->address,

           ]);
           DB::commit();
             return response()->json([
                'status' => 'Add',
                'company'=> $company,
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
    public function show(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCompantRequest $request, Company $company)
    {
        //
          try{
            DB::beginTransaction();
             $address= $company->address;

            if(isset($request->name)){
                $name = $request->name;
            }
            if(isset($request->address)){
                $address = $request->address;
            }

            $company->update([

                'name'=>$name,
                'address'=>$address
               ]);
            DB::commit();
            return response()->json([
                'status' => 'update',
                'company'=> $company,
             ]);

          }
          catch(\thrwable $th){
            DB::rollBack();
            Log::debug($th);
            $e=Log::error( $th->getMessage());
            return response()->json([
                'status' => 'error'
            ]);
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {

        if ($company) {

             $employees = $company->employees()->delete();
               $company->delete();
    }
        return response()->json([
            'status' =>'delete',

          ]);

    }
    //get empolyee refrence compnay
    public function getEmpolyee(){
        $company=company::with('employees')->get();
         return response()->json($company);
    }
}
