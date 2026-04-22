<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\MateriTugasMahasiswa;
use Illuminate\Http\Request;

class MateriTugasMahasiswaController extends Controller
{
    public function maintenance()
    {
        $data = [
            'title'                              => 'Materi Dan Tugas',
            'activeTugasDanMateri'               => 'active',
        ];
        
        return view('maintenance', $data);  
    } 
}