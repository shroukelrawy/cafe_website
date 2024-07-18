<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title="users";
        return view('dashboard.users',compact('title'));
    }

}
