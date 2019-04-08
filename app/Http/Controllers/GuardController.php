<?php

namespace App\Http\Controllers;

use App\Guard;
use App\Fingerprint;
use App\Guarantor;

use App\Utils;

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
        $guards = Guard::with('duty_rosters', 'duty_rosters.site')->paginate(15);

        return view('guards')->with('guards', $guards);
        /*return response()->json([
            'guards' => $guards
        ]);*/
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
        return view('guard-add');
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
            'emergency_contact' => 'required|string'
        ]);
        
        if(Guard::where('national_id', $request->national_id)->get()->count() > 0){
            return response()->json([
                'error' => $result,
                'message' => 'National ID number already exists'
            ]);
        }

        if(Guard::where('SSNIT', $request->SSNIT)->get()->count() > 0){
            return response()->json([
                'error' => $result,
                'message' => 'SSNIT number already exists'
            ]);
        }

        $guard = new Guard();
        
        $guard_id = md5(microtime().$request->firstname);
        $guard_id = substr($guard_id, 0, 18);
        $guard->id = $guard_id;
        $guard->firstname = $request->firstname;
        $guard->lastname = $request->lastname;
        $guard->dob = date('Y-m-d', strtotime($request->dob));
        $guard->gender = $request->gender;
        $guard->marital_status = $request->marital_status;
        $guard->occupation = $request->occupation;
        $guard->address = $request->address;
        $guard->national_id = $request->national_id;
        $guard->phone_number = $request->phone_number;
        $guard->SSNIT = $request->SSNIT;
        $guard->emergency_contact = $request->emergency_contact;
        $guard->id = md5(microtime().$request->firstname);
        
        if($request->welfare == 'on'){
            $request->welfare = 1;
        }else if($request->welfare == 'off'){
            $request->welfare = 0;
        }

        $guard->welfare = $request->welfare;

        if($request->image != null){
            $fileName        = Utils::saveBase64Image($request->image, microtime().'-'.$guard->firstname, 'assets/images/guards/');
            $guard->photo = $fileName;
         }else{
            return response()->json(["error" => true,"message" => 'no-image']);
         }

         if($guard->save()){
             $fingerprint = new Fingerprint();

             $fingerprint->guard_id = $guard->id;
             $fingerprint->RTB64 = $request->RTB64;
             $fingerprint->LTB64 = $request->RTB64;
             $fingerprint->RTISO = $request->RTB64;
             $fingerprint->LTISO = $request->RTB64;

             if($fingerprint->save()){
                 $temp_guarantors = array();

                 $temp_guarantors = json_decode($request->guarantors);
                 
                 foreach($temp_guarantors as $temp){
                    $guarantor = new Guarantor();

                    $guarantor->guard_id = $guard->id;
                    $guarantor->firstname = $temp->firstname;
                    $guarantor->lastname = $temp->lastname;
                    $guarantor->dob = date('Y-m-d', strtotime($temp->dob));
                    $guarantor->gender = $temp->gender;
                    $guarantor->occupation = $temp->occupation;
                    $guarantor->address = $temp->address;
                    $guarantor->phone_number = $temp->phone_number;
                    $guarantor->national_id = $temp->national_id;

                    if(!$guarantor->save()){
                        return response()->json([
                            'error' => true,
                            'message' => 'Error trying to save a guarantor'
                        ]);
                    }
                 }
             }else{
                 return response()->json([
                    'error' => true,
                    'message' => 'Could not save fingerprint data'
                 ]);
             }

             return response()->json([
                'error' => false,
                'data' => $guard,
                'message' => 'Guard created successfully'
              ]);
         }

         return response()->json([
            'error' => true,
            'message' => 'Error creating guard'
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

    public function view(Request $request){
        $guard = Guard::where('id', $request->id)->first();

        return view('guard-details')->with('guard', $guard);
    }
}
