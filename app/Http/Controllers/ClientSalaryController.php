<?php

namespace App\Http\Controllers;

use App\ClientSalary;
use Illuminate\Http\Request;

class ClientSalaryController extends Controller
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
        $request->validate([
            'site_id' => 'required',
            'role' => 'required',
            'amount' => 'required'
        ]);

        $client_salary = new ClientSalary();

        $client_salary->site_id = $request->site_id;
        $client_salary->role = $request->role;
        $client_salary->amount = $request->amount;

        if($client_salary->save()){
            return response()->json([
                'error' => false,
                'message' => "Client's Salaries Added Successfully!"
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => "Error adding client's salaries."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientSalary  $clientSalary
     * @return \Illuminate\Http\Response
     */
    public function show(ClientSalary $clientSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientSalary  $clientSalary
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientSalary $clientSalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientSalary  $clientSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientSalary $clientSalary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientSalary  $clientSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientSalary $clientSalary)
    {
        //
    }
}
