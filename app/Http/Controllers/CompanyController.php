<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = array(
            "companyName" => "required|min:3|unique:companies,companyName",
            "email" => "required|email|unique:companies,email",
        );
        $validator = Validator::make($request->all(), $attributes);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $company = new Company();
            $company->companyName = $request->companyName;
            $company->email = $request->email;
            $company->password = bcrypt('password');
            $newCompany = $company->save();
            if ($newCompany) {
                $response = [
                    'company' => $company,
                ];
                return response($response, 201);
            } else {
                return response([
                    'message' => ['Sorry , something went wrong']
                ], 404);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company = Company::find($request->id);
        if ($company) {
            $attributes = array(
                "companyName" => "required|min:3|unique:companies,companyName,{$company->id}",
                "email" => "required|email|unique:companies,email,{$company->id}",
            );
            $validator = Validator::make($request->all(), $attributes);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $company->companyName = $request->companyName;
                $company->email = $request->email;
                // $company->password = $company->password;
                $company->save();
                if ($company) {
                    $response = [
                        'message' => 'company Updated',
                        'company' => $company
                    ];
                    return response($response, 201);
                } else {
                    return response([
                        'message' => 'These operation has failed'
                    ], 404);
                }
            }
        } else {
            return response([
                'message' => 'No company Found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Company $company)
    {
        $company = Company::find($request->id);
        if ($company) {
            $Data = $company->delete();
            if ($Data) {
                $response = [
                    'message' => 'Company Deleted'
                ];
                return response($response, 201);
            } else {
                return response([
                    'message' => 'These operation has failed'
                ], 404);
            }
        } else {
            return response([
                'message' => 'No Company Found'
            ], 404);
        }
    }
}
