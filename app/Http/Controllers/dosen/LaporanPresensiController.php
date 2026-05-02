<?php

namespace App\Http\Controllers\dosen;

use App\Models\Kelas;
use App\Models\LaporanPresensi;
use Illuminate\Http\Request;

class LaporanPresensiController extends Controller
{

    public function index(Request $request)
    {
        // 1. Ambil filter dari request, kalau tidak ada cek di session
        $filter_periode = $request->input('filter_periode', session('filter_periode'));
        $filter_tahun = $request->input('filter_tahun', session('filter_tahun'));

        // 2. Simpan kembali ke session agar "diingat" server
        session([
            'filter_periode' => $filter_periode,
            'filter_tahun' => $filter_tahun
        ]);

        $query = Kelas::query();
        $hasFilter = !empty($filter_periode) || !empty($filter_tahun);

        if ($hasFilter) {
            if (!empty($filter_periode)) {
                $query->where('periode', $filter_periode);
            }

            if (!empty($filter_tahun)) {
                $query->where('tahun_ajaran', 'like', '%' . $filter_tahun . '%');
            }

            $jadwal = $query->latest()->get();
        } else {
            $jadwal = collect();
        }

        $data = [
            'title'                 => 'Laporan Presensi',
            'activeLaporanPresensi' => 'active',
            'data'                  => $jadwal,
            'hasFilter'             => $hasFilter,
            'filter_periode'        => $filter_periode,
            'filter_tahun'          => $filter_tahun,
        ];

        return view('dosen.laporan-absensi.index', $data);
    }

    public function resetFilter()
    {
        session()->forget(['filter_periode', 'filter_tahun']);
        return redirect()->route('laporan-presensi');
    }
    
    public function maintenance()
    {
        $data = [
            'title'                     => 'Laporan Presensi',
            'activeLaporanPresensi'     => 'active',
        ];

        return view('maintenance', $data);
    }


    
}