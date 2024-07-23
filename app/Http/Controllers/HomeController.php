<?php

namespace App\Http\Controllers;
use App\Models\Category;

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
   
    public function drinkmenu()
    {
        $categories = Category::with('beverages')->latest()->take(3)->get();
        return view('index', compact('categories'));
    }
}
