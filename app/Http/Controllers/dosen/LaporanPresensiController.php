<?php

namespace App\Http\Controllers\dosen;

use App\Models\LaporanPresensi;
use Illuminate\Http\Request;

class LaporanPresensiController extends Controller
{
    
    public function index()
    {
        $data = [
            'title'                     => 'Laporan Presensi',
            'activeLaporanPresensi'     => 'active',
        ];

        return view('maintenance', $data);
    }


    
}