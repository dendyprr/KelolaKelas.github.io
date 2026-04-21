<?php

namespace App\Http\Controllers\mahasiswa;

use Illuminate\Http\Request;

class KrsMahasiswaController extends Controller
{
    public function maintenance()
    {
        $data = [
            'title'                 => 'KRS',
            'activeKRS'             => 'active',
        ];
        
        return view('maintenance', $data);  
    } 
}