<?php

namespace App\Http\Controllers\dosen;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    
    public function index()
    {
        $data = [
            'title'             => 'Pengumuman',
            'activePengumuman'  => 'active',
        ];
        return view('maintenance', $data);
    }

}