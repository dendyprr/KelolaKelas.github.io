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

        $now = Carbon::now();
        $bulan = $now->month;

        if ($bulan >= 2 && $bulan <= 8) {
            $periodeAktif = 'Ganjil';
        } else {
            // Ini mencakup bulan 9, 10, 11, 12 dan bulan 1
            $periodeAktif = 'Genap';
        }

        $hariIni = Carbon::now()->translatedFormat('l');
        $hariBesok = Carbon::tomorrow()->translatedFormat('l'); 
        $tahunSekarang = $now->year;
        $bulan = $now->month; 
        
        $pertemuanHariIni = Kelas::where('user_id', auth()->id()) 
                                            ->where('hari', $hariIni)
                                            ->where('periode', $periodeAktif)
                                            ->where('tahun_ajaran', $tahunSekarang)
                                            ->orderBy('jam_mulai', 'asc')
                                            ->get();

        $pertemuanBesok = Kelas::where('user_id', auth()->id())
                                            ->where('hari', $hariBesok)
                                            ->where('periode', $periodeAktif)
                                            ->where('tahun_ajaran', $tahunSekarang)
                                            ->orderBy('jam_mulai', 'asc')
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