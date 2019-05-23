<?php

namespace App\Http\Controllers;

use App\Guarantor;
use App\Guard;
use Illuminate\Http\Request;

class GuarantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $request->validate([
            "firstname" => "required",
            "guard_id" => "required",
            "lastname" => "required",
            "dob" => "required",
            "gender" => "required",
            "occupation" => "required",
            "address" => "required",
            "phone" => "required",
            "national_id" => "required"
        ]);
        $guarantor = new Guarantor();
        $guarantor->guard_id = $request->guard_id;
        $guarantor->firstname = $request->firstname;
        $guarantor->lastname = $request->lastname;
        $guarantor->dob = date('Y-m-d', strtotime($request->dob));
        $guarantor->gender = $request->gender;
        $guarantor->occupation = $request->occupation;
        $guarantor->address = $request->address;
        $guarantor->phone_number = $request->phone;
        $guarantor->national_id = $request->national_id;

        if($guarantor->save()){
            return response()->json([
                'error' => false,
                'message' => "Guarantor added"
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => "Could not save guarantor"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function show(Guarantor $guarantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function edit(Guarantor $guarantor)
    {
        $guarantor = new Guarantor();

        return view('edit-guarantor', \compact('guarantor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guarantor $guarantor)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'occupation' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'national_id' => 'required'
        ]);

        if(Guarantor::where('national_id', $request->national_id)->get()->count() > 0){
            return response()->json([
                'error' => $result,
                'message' => 'National ID number already exists'
            ]);
        }

        $guarantor = Guarantor::where('id', $request->id)->first();
        
        $guarantor->firstname = $request->firstname;
        $guarantor->lastname = $request->lastname;
        $guarantor->dob = $request->dob;
        $guarantor->gender = $request->gender;
        $guarantor->occupation = $request->occupation;
        $guarantor->address = $request->address;
        $guarantor->phone_number = $request->phone_number;
        $guarantor->national_id = $request->national_id;

        if($guarantor->update()){
            return response()->json([
                'error' => false,
                'data' => $guarantor,
                'message' => 'Guarantor Updated Successfully'
            ], 201);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error updating guarantor'
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guarantor $guarantor)
    {
        //
    }
}
