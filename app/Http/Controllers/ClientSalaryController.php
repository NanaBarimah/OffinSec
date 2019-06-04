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
            'client_id' => 'required',
            'guard_id' => 'required',
            'amount' => 'required' 
        ]);
        
        $client = ClientSalary::where('client_id', $request->client_id)->where('guard_id', $request->guard_id)->update(['active' => 0]);

        $client_salary = new ClientSalary();

        $client_salary->client_id = $request->client_id;
        $client_salary->guard_id = $request->guard_id;
        $client_salary->amount = $request->amount;
        $client_salary->active = 1;

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

    public function updateSalary(Request $request)
    {
        $request->validate([
            'guard_id' => 'required',
            'client_id' => 'required',
            'amount' => 'required'
        ]);

        $client_salary = ClientSalary::where('client_id', $request->client_id)->where('guard_id', $request->guard_id)->first();
        $client_salary->amount = $request->amount;

        if($client_salary->update()){
            return response()->json([
                'error' => false,
                'Client Salary' => $client_salary,
                'message' => 'Guard Salary Updated Successfully!'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Could not update guard salary. Try Again!'
            ]);
        }
    }

    public function salaryRole(Request $request)
    {
        $guard_salary = ClientSalary::whereHas('guard_clientSalary', function($q) {
            $q->where('occupation', $request->occupation);
        })->where('client_id', $request->client_id)->update(['amount' => $request->amount]);

        return response()->json([
            'error' => false,
            'data' => $guard_salary,
            'message' => $guard_salary ? 'Salary Updated Successfully!' : 'Could not update salary. Try Again!'
        ]);
    }

    public function runUpdate(Request $request){
        $request->validate([
            "client_id" => "required",
            "guard_id" => "required",
            "amount" => "required"
        ]);

        $client_salary = ClientSalary::where([['client_id', $request->client_id], ['guard_id', $request->guard_id], ['active', 1]])->first();

        if($client_salary !== null){
            $this->updateSalary($request);
        }else{
            $this->store($request);
        }

    }
}
