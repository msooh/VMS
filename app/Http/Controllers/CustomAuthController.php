<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function custom_login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('name', 'password');
        if(Auth::attempt($credentials))
        {
            return redirect()->intended('dashboard')->withSuccess('login');
        }
        return redirect('login')->with('error', 'Invalid Username or password');
    }
    public function registration()
    {
        return view('auth.registration');
    }
    public function custom_registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

        ]);

        return redirect('registration')->with('success', 'User Registered Successfully');
    }
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('dashboard');
        }
        return redirect('login');
        
    }
    public function logout()
    {
        session::flush();
        Auth::logout();
        return redirect('login');
    }

}
