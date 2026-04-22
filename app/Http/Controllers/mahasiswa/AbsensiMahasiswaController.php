<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\AbsensiMahasiswa;
use Illuminate\Http\Request;

class AbsensiMahasiswaController extends Controller
{
    public function maintenance()
    {
        $data = [
            'title'                     => 'Absen Qr Code',
            'activeAbsen'               => 'active',
        ];
        
        return view('maintenance', $data);  
    } 
}