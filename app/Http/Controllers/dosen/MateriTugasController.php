<?php

namespace App\Http\Controllers\dosen;

use App\Models\MaterTugas;
use Illuminate\Http\Request;

class MateriTugasController extends Controller
{
    
    public function index()
    {
        $data = [
            'title'                     => 'Tugas Dan Materi',
            'activeMateriTugas'         => 'active',
        ];

        return view('maintenance', $data);
    }

}