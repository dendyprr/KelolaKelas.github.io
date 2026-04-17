<?php

namespace App\Http\Controllers\dosen;

use App\Models\dashboard;
use App\Models\Kelas;
use App\Models\Pertemuan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        Carbon::setLocale('id');
        $hariIni = Carbon::today()->toDateString(); 
        $hariBesok = Carbon::tomorrow()->toDateString(); 
        
        $pertemuanHariIni = Pertemuan::with('kelas') 
        ->whereDate('tanggal', $hariIni)
        ->get();

        $pertemuanBesok = Pertemuan::with('kelas')
        ->whereDate('tanggal', $hariBesok)
        ->get();

        $totalKelas = Kelas::count();
        $totalMahasiswa = User::where('role_id', 3)->count();
        
        $data = [
            'title'                 => 'Dashboard',
            'activeDashboard'       => 'active',
            'pertemuanHariIni'      => $pertemuanHariIni,
            'pertemuanBesok'        => $pertemuanBesok,
            'totalKelas'            => $totalKelas,
            'totalMahasiswa'        => $totalMahasiswa
        ];
        return view('dosen.dashboard.index', $data);
    }


  
}