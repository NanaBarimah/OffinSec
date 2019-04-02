<?php

namespace App\Http\Controllers;

use App\Guard;
use App\Fingerprint;
use App\Guarantor;
use Illuminate\Http\Request;

class GuardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guards = Guard::all();

        return view('all-guard')->with('guards', $guards);
    }

    public function getGuardGuarantor(Request $request)
    {
        $guard = Guard::with('guarantor')->where('id', $request->id)->first();

        return view('guard-guarantor')->with('guard', $guard);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-guard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = true;
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'dob' => 'required|string',
            'gender' => 'required|string',
            'marital_status' => 'required|string',
            'occupation' => 'required|string',
            'address' => 'required|string',
            'national_id' => 'required|string',
            'phone_number' => 'required|string',
            'SSNIT' => 'required|string',
            'emergency_contact' => 'required|string',
            'photo' => 'required|string'
        ]);

        $guard = new Guard();

        $guard->firstname = $request->firstname;
        $guard->lastname = $request->lastname;
        $guard->dob = $request->dob;
        $guard->gender = $request->gender;
        $guard->marital_status = $request->marital_status;
        $guard->occupation = $request->occupation;
        $guard->address = $request->address;
        $guard->national_id = $request->national_id;
        $guard->phone_number = $request->phone_number;
        $guard->SSNIT = $request->SSNIT;
        $guard->emergency_contact = $request->emergency_contact;

        if ($request->hasFile('image')){
            $fileName        = Utils::saveImage($request, 'image', 'img/guard');
            $guard->photo = $fileName;
         }else{
            return response()->json(["error" => true,"message" => 'no-image']);
         }

         if($guard->save()){
             $fingerprint = new Fingerprint();

             $fingerprint->guard_id = $guard->id;
             $fingerprint->RTB64 = $request->RTB64;
             $fingerprint->LTB64 = $request->LTB64;
             $fingerprint->RTISO = $request->RTISO;
             $fingerprint->LTISO = $request->LTISO;

             if($fingerprint->save()){
                $guarantor = new Guarantor();

                $guarantor->guard_id = $guard->id;
                $guarantor->firstname = $request->firstname;
                $guarantor->lastname = $request->lastname;
                $guarantor->dob = $request->dob;
                $guarantor->gender = $request->gender;
                $guarantor->occupation = $request->occupation;
                $guarantor->address = $request->address;
                $guarantor->phone_number = $request->phone_number;
                $guarantor->national_id = $request->national_id;

                if($guarantor->save()){
                    $result = false;
                }
             }
         }

         return response()->json([
            'error' => $result,
            'data' => $guard,
            'message' => !$result ? 'Guard created successfully' : 'Error creating guard'
          ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function show(Guard $guard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function edit(Guard $guard)
    {
        $guard = Guard::where('id', $request->id)->first();

        return view('edit-guard', \compact('guard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guard $guard)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'dob' => 'required|string',
            'gender' => 'required|string',
            'marital_status' => 'required|string',
            'occupation' => 'required|string',
            'address' => 'required|string',
            'national_id' => 'required|string',
            'phone_number' => 'required|string',
            'SSNIT' => 'required|string',
            'emergency_contact' => 'required|string'
        ]);

        $guard->firstname = $request->firstname;
        $guard->lastname = $request->lastname;
        $guard->dob = $request->dob;
        $guard->gender = $request->gender;
        $guard->marital_status = $request->marital_status;
        $guard->occupation = $request->occupation;
        $guard->address = $request->address;
        $guard->national_id = $request->national_id;
        $guard->phone_number = $request->phone_number;
        $guard->SSNIT = $request->SSNIT;
        $guard->emergency_contact = $request->emergency_contact;

        if ($request->hasFile('image')){
            $fileName        = Utils::saveImage($request, 'image', 'img/guard');
            $guard->photo = $fileName;
        }

        $status = $guard->update();

         return response()->json([
            'data' => $guard,
            'error'  => !$status,
            'message' => $status ? 'Guard updated!' : 'Error updating guard'
         ]);
    }

    public function welfare (Request $request)
    {
        $guard = Guard::where('id', $request->id)->first();

        $welfare        = $request->welfare;
        $guard->welfare = $welfare;

        if ($guard->save())
        {
            return response()->json([
            'data'    => $guard,
            'message' => 'Guard is a member of the welfare'
            ]);
        }else{
            return response()->json([
            'message' => 'Nothing to update',
            'error'   => true
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guard $guard)
    {
        //
    }
}
