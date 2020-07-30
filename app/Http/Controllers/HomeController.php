<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Routine;
use App\Tracker;

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

        $routines = Routine::all()->where('user_id', auth()->user()->id);
        $trackers = Tracker::all()->where('user_id', auth()->user()->id);

        return view('home', compact('routines', 'trackers'));
    }
}

