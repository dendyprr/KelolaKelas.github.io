<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $data = [
            'title'                     => 'Pengaturan',
        ];

        return view('maintenance', $data);
    }
}