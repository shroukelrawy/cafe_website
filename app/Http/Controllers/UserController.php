<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $columns =[
            'fullname',
            'username',
            'email',
            'password',
            'active',];

    public function index()
    {
        $users = User::all();
        $title="users";
        return view('dashboard.users',compact('title','users'));
    }

    public function edit($id)
    {
        $user = User::find($id); 
        $title="users";
        return view('dashboard.edituser', compact('title','user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id); 

     
        $user = User::findOrFail($id);
    
        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    
        $user['active'] = $request->has('active') ? 1 : 0;
    
        $user->update();
    
        return redirect('dashboard/users')->with('success', 'User updated successfully!');
    }

}
