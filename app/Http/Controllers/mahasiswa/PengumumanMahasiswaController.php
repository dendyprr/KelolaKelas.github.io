<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\PengumumanMahasiswa;
use Illuminate\Http\Request;

class PengumumanMahasiswaController extends Controller
{
    public function maintenance()
    {
        $data = [
            'title'                     => 'Pengumuman',
            'activePengumuman'          => 'active',
        ];
        
        return view('maintenance', $data);  
    } 
}