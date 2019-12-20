<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

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
        $user = Sentinel::findById(Auth::id());
        if ($user) {
            Sentinel::login($user);
            if ($user == Sentinel::check()) {
                if (Sentinel::inRole('Admin')) {
                    return redirect('admin/user');
                } else if (Sentinel::inRole('Boss')) {
                    return view('layouts.boss');
                } else {
                    return view('layouts.user');
                }
            }
        }
    }
}
