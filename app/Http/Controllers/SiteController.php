<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::all();

        return response()->json($sites, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-site');
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
            'client_id' => 'required',
            'name' => 'required',
            'location' => 'required',
            'phone_number' => 'required' 
        ]);
        
        if(Site::where([['name', $request->name], ['client_id', $request->client_id]])->get()->count() > 0){
            return response()->json([
                'error' => true,
                'message' => 'Site name already exists in this client'
            ]);
        }

        $site = new Site();

        $site->client_id = $request->client_id;
        $site->name = $request->name;
        $site->location = $request->location;
        $site->phone_number = $request->phone_number;

        if($site->save()){
            return response()->json([
                'data' => $site,
                'error' => false,
                'message' => 'Site created successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error creating site'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        $site = new Site();

        return view('edit-site', \compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        $request->validate([
            'client_id' => 'required',
            'name' => 'required',
            'location' => 'required',
            'phone_number' => 'required' 
        ]);

        $site->client_id = $request->client_id;
        $site->name = $request->name;
        $site->location = $request->location;
        $site->phone_number = $request->phone_number;

        if($site->update()){
            return response()->json([
                'error' => false,
                'data' => $site,
                'message' => 'Site updated successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error updating site'
            ]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        //
    }
}
