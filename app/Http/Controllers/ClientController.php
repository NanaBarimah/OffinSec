<?php

namespace App\Http\Controllers;

use App\Client;
use App\Guard;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('sites', 'sites.duty_roster.guards')->get();

        foreach($clients as $client){
            $assigned_guards = array();

            foreach($client->sites as $site){
                if($site->duty_roster != null){
                    foreach($site->duty_roster->guards as $guard){
                        array_push($assigned_guards, $guard);
                    }
                }
            }

            $client->guards = collect($assigned_guards)->unique('id');
        }


        return view('clients')->with('clients', $clients);

        /*return response()->json([
            'clients' => $clients
        ]);*/
    }

    public function getClientSites()
    {
        $client = Client::with('sites')->get();

        return response()->json($client, 200);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-client');
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
            'name' => 'required|string',
            'phone_number' => 'required',
            'email' => 'required',
            'contact_person_name' => 'required',
            'number_of_guards' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        $client = new Client();
        
        $client->name = $request->name;
        $client->phone_number = $request->phone_number;
        $client->email = $request->email;
        $client->contact_person_name = $request->contact_person_name;
        $client->number_of_guards = $request->number_of_guards;
        $client_id = md5(microtime().$client->name.'OFFINCLIENT');
        $client_id = substr($client_id, 0, 12);
        $client->id = $client_id;
        $client->description = $request->description;
        $client->start_date = date('Y-m-d', strtotime($request->start));
        $client->end_date = date('Y-m-d', strtotime($request->end));

        if($client->save()){
            return response()->json([
                "error" => false, 
                'data' => $client,
                'message' => 'Client created successfully'
            ]);
        }else{
           return response()->json([
               'error' => true,
               'message' => 'Error creating client'
           ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $client = new Client();

        return view('edit-client', \compact('cleint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required',
            'email' => 'required',
            'contact_person_name' => 'required',
            'number_of_guards' => 'required'
        ]);

        $client->name = $request->name;
        $client->phone_number = $request->phone_number;
        $client->email = $request->email;
        $client->contact_person_name = $request->contact_person_name;
        $client->number_of_guards = $request->number_of_guards;

        if($client->update()){
            return response()->json([
                'error' => false,
                'data' => $client,
                'message' => 'Client Updated Successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error updating client'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function view(Request $request){
        $client = Client::with('sites', 'sites.duty_roster.guards')
        ->where('id', $request->id)->first();
        
        $assigned_guards = array();
        
        foreach($client->sites as $site){
            if($site->duty_roster != null){
                foreach($site->duty_roster->guards as $guard){
                    array_push($assigned_guards, $guard);
                }
            }
        }

        $client->guards = collect($assigned_guards)->unique('id');
        
        $guards = Guard::all();

        return view('client-details')->with('client', $client)->with('guards', $guards);
    }
}
