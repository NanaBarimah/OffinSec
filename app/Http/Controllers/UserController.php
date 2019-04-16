<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users')->with('users', $users);
    }

    public function allUsers()
    {
        $users = User::all();

        return response()->json([
            'data' => $users
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-user');
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
            'username' => 'required|string|unique:users',
            'phone_number' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string'
        ]);

        $user = new User();
        
        $userId = md5($request->username.microtime());
        $userId = substr($userId, 0, 18);
        $user->id = $userId;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        $user->password = $request->password;
        $user->role = $request->role;

        if($user->save()){
            $result = false;

            return response()->json([
                'data' => $user,
                'message' => 'User Created Successfully',
                'error' => $result,
            ]);
        }else{
            return response()->json([
                'error' => $result,
                'message' => 'Error creating user. Try Again!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = new User();

        return view('edit-user')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $status = true;

        $request->validate([
            'id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required'
        ]);
        $user = User::where('id', $request->id)->first();

        if(request('password') != null){
            $request->validate([
                'password' => 'confirmed'
            ]);

            $user->password = $request->password;
        }
        
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role = $request->role;

        if($user->update()){
            $status = false;
        }

        return response()->json([
            'error' => $status,
            'message' => !$status ? 'User Updated Successfully' : 'Could not update user'
        ]);
    }

    public function toggleActive(Request $request)
      {
         $request->validate([
             'user_id' => 'required'
         ]);

         $user = User::where('id', $request->user_id)->first();

         if($user->active == 0){
            $user->active = 1;
         }else if($user->active == 1){
            $user->active = 0;
         }

         if($user->save())
         {
            return response()->json([
               'data'    => $user,
               'message' => $user->active == 1 ? 'User activated' : 'User deactivated',
               'error' => false
            ]);
         }
         else
         {
            return response()->json([
               'message' => 'Could not update the active status of the user',
               'error'   => true
            ]);
         }
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
