<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
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
            'guard_id' => 'required',
            'amount' => 'required',
            'bank_name' => 'required',
            'bank_branch' => 'required',
            'total_deductions' => 'required', 
            'month' => 'required'
        ]);

        $salary = new Salary();

        $salary->guard_id = $request->guard_id;
        $salary->amount = $request->amount;
        $salary->bank_name = $request->bank_name;
        $salary->bank_branch = $request->bank_branch;
        $salary->total_deductions = $request->total_deductions;
        $salary->month = date('Y-m-d', strtotime($request->month));

        if($salary->save()){
            return response()->json([
                'error' => false,
                'message' => 'Salary Added Successfully!'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Could not add salary'
        ]);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }

    public function all(){
        return view('salaries');
    }
}
