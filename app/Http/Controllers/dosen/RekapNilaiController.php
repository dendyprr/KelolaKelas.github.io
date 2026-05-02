<?php

namespace App\Http\Controllers\dosen;

use App\Models\InputNilai;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class RekapNilaiController extends Controller
{
    
    public function index($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $activeManagemen =  'active';
        
        $mahasiswas = Mahasiswa::whereHas('kelas', function($q) use ($kelas_id) {
            $q->where('kelas_id', $kelas_id);
        })->with(['absensis' => function($q) use ($kelas_id) {
            // Kita hanya ambil absensi di kelas yang sedang dibuka
            $q->whereHas('pertemuan', function($p) use ($kelas_id) {
                $p->where('kelas_id', $kelas_id);
            });
        }])->get();

        return view('dosen.managemen-kelas.input-nilai.index', compact('kelas', 'mahasiswas', 'kelas_id', 'activeManagemen'));
    }

    public function addProccess(Request $request, $kelas_id)
    {
        foreach ($request->nilai_uts as $mahasiswa_id => $uts) {
            $uas = $request->nilai_uas[$mahasiswa_id];
            $mhs = Mahasiswa::find($mahasiswa_id);

            // 1. Hitung Rata-rata Tugas
            $rata_tugas = $mhs->absensis()
                ->whereHas('pertemuan', function($q) use ($kelas_id) {
                    $q->where('kelas_id', $kelas_id);
                })->avg('nilai_tugas') ?? 0;

            // 2. HITUNG JUMLAH ALPA
            $jumlah_alpa = $mhs->absensis()
                ->whereHas('pertemuan', function($q) use ($kelas_id) {
                    $q->where('kelas_id', $kelas_id);
                })
                ->where('status', 'Alpa')->count();

            // 3. Hitung Nilai Akhir Dasar
            $nilai_akhir = ($rata_tugas * 0.2) + ($uts * 0.3) + ($uas * 0.5);

            // 4. Tentukan Grade (DENGAN LOGIKA ALPA)
            if ($jumlah_alpa >= 3) {
                $grade = 'C'; // Otomatis C jika Alpa >= 3
            } else {
                if($nilai_akhir >= 85) $grade = 'A';
                elseif($nilai_akhir >= 75) $grade = 'B';
                elseif($nilai_akhir >= 60) $grade = 'C';
                elseif($nilai_akhir >= 45) $grade = 'D';
                else $grade = 'E';
            }

            // 5. Simpan
            InputNilai::updateOrCreate(
                ['mahasiswa_id' => $mahasiswa_id, 'kelas_id' => $kelas_id],
                [
                    'tugas' => $rata_tugas,
                    'uts' => $uts,
                    'uas' => $uas,
                    'nilai_akhir' => $nilai_akhir,
                    'grade' => $grade
                ]
            );
        }
        return redirect()->back()->with('success', 'Nilai berhasil diproses!');
    }

    public function maintenance()
    {
        $data = [
            'title'                 => 'Rekap Nilai',
            'activeRekapNilai'      => 'active',
        ];
        
        return view('maintenance', $data);
    }

}