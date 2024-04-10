<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'user_password' => 'required',
        ]);

        $user = DB::table('users')->where('user_name', $request->input('user_name'))->first();

        if ($user && password_verify($request->input('user_password'), $user->user_password)) {
            return redirect()->intended('home');
        }

        return redirect()->back()->withInput()->withErrors(['login_error' => 'Invalid username or password']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,user_name',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        DB::table('users')->insert([
            'user_name' => $request->input('username'),
            'user_email' => $request->input('email'),
            'user_password' => bcrypt($request->input('password')),
            'created_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }


    public function welcome()
    {
        return view('home');
    }

    public function manage()
    {
        return view('manage');
    }
}
