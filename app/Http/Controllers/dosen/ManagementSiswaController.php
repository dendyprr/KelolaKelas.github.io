<?php

namespace App\Http\Controllers\dosen;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Pertemuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagementSiswaController extends Controller
{
    


    public function addPrensensiMahasiswaForm($id)
    {
        $data = [
            'title'             => 'Detail Management Kelas',
            'activeManagemen'   => 'active',
        ];
    }

    
}