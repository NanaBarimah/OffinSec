<?php

namespace App\Http\Controllers;

use App\Occurrence;
use Illuminate\Http\Request;

class OccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $occurrences = Occurrence::all();
        return view('occurrences');
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
        $request->validate([
            'occurrence' => 'required',
            'site_id' => 'required'
        ]);

        $occurrence = new Occurrence();

        $occurrence->occurrence = $request->occurrence;
        $occurrence->site_id = $request->site_id;

        if($occurrence->save()){
            return response()->json([
                'data' => $occurrence,
                'error' => false,
                'message' => 'Occurrence has been recorded successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error recording occurrence'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Occurrence  $occurrence
     * @return \Illuminate\Http\Response
     */
    public function show(Occurrence $occurrence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Occurrence  $occurrence
     * @return \Illuminate\Http\Response
     */
    public function edit(Occurrence $occurrence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Occurrence  $occurrence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occurrence $occurrence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Occurrence  $occurrence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occurrence $occurrence)
    {
        //
    }
}
