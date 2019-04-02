<?php

namespace App\Http\Controllers;

use App\Access_Code;
use App\Client;
use Illuminate\Http\Request;

class AccessCodeController extends Controller
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
        return view('create-access_code');
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
        ]);

        $access_code = new Access_Code();

        $access_code->client_id = $request->client_id;
        $access_code->access_code = $this->generateCode(24);

        if($access_code->save()){
            return response()->json([
                'error' => false,
                'data' => $access_code,
                'message' => 'Access code generated successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error generating access code'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Access_Code  $access_Code
     * @return \Illuminate\Http\Response
     */
    public function show(Access_Code $access_Code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Access_Code  $access_Code
     * @return \Illuminate\Http\Response
     */
    public function edit(Access_Code $access_Code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Access_Code  $access_Code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Access_Code $access_Code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Access_Code  $access_Code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Access_Code $access_Code)
    {
        //
    }

    public function generateCode($length)
    {
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $strcode   = strlen($str)-1;
        $id  = '';

        for ($i = 0; $i < $length; $i++) {
                $id .= $chars[mt_rand(0,$clen)];
        }

        return $id;
    }
}
