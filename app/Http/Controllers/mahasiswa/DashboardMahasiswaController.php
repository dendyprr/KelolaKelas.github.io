<?php

namespace App\Http\Controllers\mahasiswa;

use Illuminate\Http\Request;

class DashboardMahasiswaController extends Controller
{
    public function maintenance()
    {
        $data = [
            'title'                 => 'Dashboard',
            'activeDashboard'       => 'active',
        ];
        
        return view('maintenance', $data);  
    }
}