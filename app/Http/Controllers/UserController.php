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
                $title = "List of Users";
                return view('dashboard.users', compact('title', 'users'));
            }
        
            public function create()
            {
                $title = "Add User";
                return view('dashboard.adduser', compact('title'));
            }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'fullname' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'active' => 'sometimes',
            ]);
            User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                $user['active'] = $request->has('active') ? 1 : 0,
            ]);    
            return redirect()->route('dashboard.users')->with('success', 'User added successfully!');
        } catch (\Exception $e) {
           
            return redirect()->route('dashboard.users')->with('error', 'Failed to add user: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $user = User::find($id); 
        $title="Edit User";
        return view('dashboard.edituser', compact('title','user'));
    }

    
    public function update(Request $request, $id)
    {
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
