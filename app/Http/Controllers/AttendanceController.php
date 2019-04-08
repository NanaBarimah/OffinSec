<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Guard;
use App\Site;
use App\Duty_Roster;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = Attendance::with('guard')->get();

        return response()->json($attendance, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-attendance');
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
            'guard_id' => 'required',
            'site_id' => 'required',
            'date_time' => 'required'
        ]);

        $attendance = new Attendance();

        $attendance->guard_id = $request->guard_id;
        $attendance->site_id = $request->site_id;
        $attendance->date_time = $request->date_time;

        if($attendance->save()){
            return response()->json([
                'error' => false,
                'data' => $attendance,
                'message' => 'Attendance Recorded Successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error recording attendance, Try Again!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function view()
    {
        $guards = Guard::all();
        $sites = Site::all();

        return view('attendance')->with('guards', json_encode($guards))->with('sites', $sites);
    }

    public function getAttendanceByDate(Request $request){
        $request->validate([
            'date' => 'required',
            'site' => 'required'
        ]);

        $attendance = Attendance::with('site', 'owner_guard')
        ->where('site_id', $request->site)->whereRaw("DATE(date_time) = DATE('$request->date')")->get();
    

        return response()->json([
            'error' => false,
            'data' => $attendance
        ]);
    }
}
