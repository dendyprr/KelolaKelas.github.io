<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function index()
    {
        // $data = [
        //     'title'                     => 'Profile',
        // ];

        return view('auth.login');
    }

    public function loginProccess(Request $request)
    {
       $request->validate([
            'email'             => 'required',
            'password'          => 'required'
        ], [
            'email.required'    => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('dashboard')->with('success', 'Berhasil login');
        } else {
            return redirect()->back()->with('error', 'tidak bisa login');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('auth-login');
    }

}