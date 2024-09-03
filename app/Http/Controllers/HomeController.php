<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
    {
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

    public function search(Request $request)
    {
        $query = Show::query();

        if ($request->has('name') && $request->name != '') {
            $query->where('title', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereHas('representations', function ($q) use ($request) {
                $q->whereDate('when', $request->date);
            });
        }

        $shows = $query->get();

        return view('home.index', compact('shows'));
    }
}
