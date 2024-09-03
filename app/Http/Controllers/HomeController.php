<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage(){
        return view("home.homepage");
    }
    public function home()
    {
        return view("home.homepage");
    }

    public function index()
    {
        $shows = Show::all();
        return view('home.index', compact('shows'));
    }
}

