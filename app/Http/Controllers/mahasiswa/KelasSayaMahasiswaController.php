<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\KelasSayaMahasiswa;
use Illuminate\Http\Request;

class KelasSayaMahasiswaController extends Controller
{
    public function maintenance()
    {
        $data = [
            'title'                         => 'Kelas Saya',
            'activeKelasSaya'               => 'active',
        ];
        
        return view('maintenance', $data);  
    } 
}