<?php

namespace App\Http\Controllers\dosen;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'title'                     => 'Profile',
        ];

        return view('maintenance', $data);
    }

    public function settingsIndex()
    {
        $data = [
            'title'                     => 'Pengaturan',
        ];

        return view('maintenance', $data);
    }
}