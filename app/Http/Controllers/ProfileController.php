<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'title'                 => 'Profile',
            'data'                  => User::with(['mahasiswa', 'role'])->findOrFail(auth()->id())
        ];

        return view('profile.index', $data);
    }

    
}