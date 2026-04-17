<?php

namespace App\Http\Controllers\dosen;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        return view('layouts.app');
    }
}