<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guard;
use App\Client;
use App\User;
use App\Deduction;
use Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $guards = Guard::count();

        $clients = Client::count();

        $users = User::count();

        $today = Carbon\Carbon::today();
        $deductions = Deduction::whereBetween('created_at', [$today->startOfMonth(), $today->endOfMonth()])->count();

        return view('home')
            ->with('guards', $guards)
            ->with('clients', $clients)
            ->with('users', $users)
            ->with('deductions', $deductions);
    }
}
