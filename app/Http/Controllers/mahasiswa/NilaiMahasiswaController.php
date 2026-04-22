<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\NilaiMahasiswa;
use Illuminate\Http\Request;

class NilaiMahasiswaController extends Controller
{
   public function maintenance()
    {
        $data = [
            'title'                     => 'Nilai',
            'activeNilai'               => 'active',
        ];
        
        return view('maintenance', $data);  
    } 
}