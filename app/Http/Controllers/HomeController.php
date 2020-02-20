<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }
}

/*
echo "# mrsif" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/matejrek/mrsif.git
git push -u origin master
*/