<?php

namespace App\Http\Controllers;

use App\Guard;
use App\Fingerprint;
use App\Guarantor;
use App\Client;
use App\Site;

use DB;

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
            'emergency_contact' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string'
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
        $guard->bank_name = $request->bank_name;
        $guard->account_number = $request->account_number;
        
        if($request->welfare == 'on'){
            $request->welfare = 1;
        }else if($request->welfare == 'off' || $request->welfare == null){
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
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'dob' => 'required|string',
            'gender' => 'required|string',
            'marital_status' => 'required|string',
            'occupation' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'SSNIT' => 'required|string',
            'emergency_contact' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string'
        ]);
        
        $guard = Guard::where('id', $request->id)->first();
        $guard->firstname = $request->firstname;
        $guard->lastname = $request->lastname;
        $guard->dob = $request->dob;
        $guard->gender = $request->gender;
        $guard->marital_status = $request->marital_status;
        $guard->occupation = $request->occupation;
        $guard->address = $request->address;
        $guard->phone_number = $request->phone_number;
        $guard->SSNIT = $request->SSNIT;
        $guard->emergency_contact = $request->emergency_contact;
        $guard->bank_name = $request->bank_name;
        $guard->account_number = $request->account_number;

        if($guard->update()){
            return response()->json([
                'error'  => false,
                'data' => $guard,
                'message' => 'Guard updated successfully'
            ]);
        }else{
            return response()->json([
                'error'  => true,
                'message' => 'Error updating guard'
            ]);
        }
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
        $status = $guard->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Guard Deleted' : 'Error Deleting Guard'
        ]);
    }

    public function view(Request $request){
        $guard = Guard::with('duty_rosters', 'duty_rosters.site', 'duty_rosters.site.client')->where('id', $request->id)->first();
        //$guard = DB::select("SELECT sites.name, guards.* FROM guard_roster, duty_rosters, guards, sites WHERE guard_roster.guard_id = guards.id AND guard_roster.duty_roster_id = duty_rosters.id AND sites.id = duty_rosters.site_id AND guards.id = '$request->id' group by guards.id, sites.name ");

        return view('guard-details')->with('guard', $guard);
        /*return response()->json([
            'data' => $guard
        ]);*/
    }

    public function welfareGuards()
    {
        $guards = Guard::where('welfare', 1)->get();

        return view('welfare-guard')->with('guards', $guards);
    }

    public function reports(){
        $clients = Client::with('sites')->get();
        return view('guard-report', compact('clients'));
    }

    public function getGuardsByGender(){
        $guards = DB::select("SELECT count(id) as total, gender from guards group by gender");
        return response()->json([
            'error' => false,
            'data' => $guards
        ]);
    }

    public function getGuardsByAgeRange(){
        $guards = DB::select("SELECT SUM(IF(age < 20,1,0)) as 'Under 20', SUM(IF(age BETWEEN 20 and 29,1,0)) as '20 - 29',
        SUM(IF(age BETWEEN 30 and 39,1,0)) as '30 - 39', SUM(IF(age BETWEEN 40 and 49,1,0)) as '40 - 49', SUM(IF(age BETWEEN 50 and 149,1,0)) as 'Over 50'
        FROM (SELECT TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age FROM guards) as derived");

        return response()->json([
            'error' => false,
            'data' => $guards
        ]);
    }

    public function getGuardsBySite(){
        $sites = Site::with('duty_roster', 'duty_roster.guards')->get();
        
        foreach($sites as $site){
            if($site->duty_roster == null){
                $site->guard_count = 0;
            }else{
                $site->guard_count = $site->duty_roster->guards->count();
            }
        }

        return response()->json([
            'error' => false,
            'data' => $sites
        ]);
    }

    public function getSiteReport(Request $request){
        $request->validate([
            'site_id' => 'required',
            'start' => 'required', 
            'end' => 'required'
        ]);
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        $site_id = $request->site_id;

        $site = Site::with(['attendances' => function($q) use ($start, $end){
            $q->whereRaw("date_time BETWEEN DATE('$start') and DATE('$end')");
        }])->with(['occurrences' => function($q) use ($start, $end){
            $q->whereRaw("created_at BETWEEN DATE('$start') and DATE('$end')");
        }])->with(['incidents' => function($q) use ($start, $end){
            $q->whereRaw("created_at BETWEEN DATE('$start') and DATE('$end')");
        }])->with('attendances.guard')->where('id', $site_id)->get();

        return response()->json([
            'error' => false,
            'data' => $site
        ]);
    }
}
