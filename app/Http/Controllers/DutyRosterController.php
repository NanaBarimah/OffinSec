<?php

namespace App\Http\Controllers;

use App\Duty_Roster;
use Illuminate\Http\Request;

class DutyRosterController extends Controller
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
        return view('add-duty_roster');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required',
            'name' => 'required'
        ]);

        $duty_roster = new Duty_Roster();

        $duty_roster->site_id = $request->site_id;
        $duty_roster->name = $request->name;

        if($duty_roster->save()){
            //convert array from request to php array

            //create array from days
            $guard_roster_days = array();

            foreach($request->guard_roster as $roster){
                foreach($roster->days as $day){
                    //create a new array from the guard roster array
                    $temp = array('guard_id' => $roster->guard_id, 
                    'shift_type_id' => $roster->shift_type_id, 'duty_roster_id' => $roster->duty_roster_id,
                    'day' => $day);

                    array_push($guard_roster_days, $temp);
                }
            }

            //attach
            $duty_roster->guards()->attach($guard_roster_days);

            return \response()->json([
                'error' => false,
                'data' => $duty_roster,
                'message' => 'Duty Roster created successfully'
            ]);
        }else{
            return \response()->json([
                'error' => true,
                'message' => 'Error creating duty roster'
            ]); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Duty_Roster  $duty_Roster
     * @return \Illuminate\Http\Response
     */
    public function show(Duty_Roster $duty_Roster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Duty_Roster  $duty_Roster
     * @return \Illuminate\Http\Response
     */
    public function edit(Duty_Roster $duty_roster)
    {
        $duty_roster = new Duty_Roster();

        return view('edit-duty_roster')->with('duty_Roster', $duty_roster);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Duty_Roster  $duty_Roster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Duty_Roster $duty_roster)
    {
        $request->validate([
            'site_id' => 'required',
            'name' => 'required'
        ]);

        $duty_roster->site_id = $request->site_id;
        $duty_roster->name = $request->name;

        if($duty_roster->update()){
            return response()->json([
                'error' => false,
                'data' => $duty_roster,
                'message' => 'Duty Roster Updated Successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error updating duty roster'
            ]);
        }


   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Duty_Roster  $duty_Roster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Duty_Roster $duty_Roster)
    {
        //
    }
}
