<?php

namespace App\Http\Controllers\dosen;

use App\Http\Requests\JadwalRequest;
use App\Models\jadwalNgajar;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JadwalNgajarController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Kelas::query();

        $hasFilter = $request->filled('filter_periode') || $request->filled('filter_tahun');

        if ($hasFilter) {
            if ($request->filled('filter_periode')) {
                $query->where('periode', $request->filter_periode);
            }

            if ($request->filled('filter_tahun')) {
                $query->where('tahun_ajaran', 'like', '%' . $request->filter_tahun . '%');
            }

            $jadwal = $query->latest()->get();
        } else {
            $jadwal = collect();
        }

        $data = [
            'title'        => 'Jadwal Ngajar',
            'activeJadwal' => 'active',
            'data'         => $jadwal,
            'hasFilter'    => $hasFilter, 
        ];

        return view('maintenance', $data);
    }

    public function add()
    {
        $data = [
            'title'              => 'Tambah Kelas Baru',
            'activeJadwal'       => 'active',
        ];
        return view('dosen.jadwal.add', $data);    
    }

    public function addProccess(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode_kelas'        => 'nullable|unique:kelas,kode_kelas', // Tambah unique
            'nama_matakuliah'   => 'required',
            'jumlah_sks'        => 'nullable|numeric',
            'semester'          => 'required|numeric',
            'tahun_ajaran'      => 'required',
            'periode'           => 'required',
            'hari'              => 'required',
            'jam_mulai'         => 'required',
            'jam_selesai'       => 'required',
            'ruangan'           => 'nullable',
        ], [
            'periode.required'          => 'Periode Tahun tidak boleh kosong',
            'kode_kelas.unique'         => 'Kode kelas sudah terdaftar',
            'tahun_ajaran'              => 'Tahun ajaran tidak boleh kosong',
            'nama_matakuliah.required'  => 'Nama Mata Kuliah tidak boleh kosong',
            'hari.required'             => 'Hari tidak boleh kosong',
            'jam_mulai.required'        => 'Jam mulai tidak boleh kosong',
            'jam_selesai.required'      => 'Jam selesai tidak boleh kosong',
            'semester.required'         => 'Semester tidak boleh kosong',
        ]);

        // Simpan ke Database
        Kelas::create([
            'kode_kelas'      => $request->kode_kelas,
            'nama_matakuliah' => $request->nama_matakuliah,
            'periode'         => $request->periode,
            'tahun_ajaran'    => $request->tahun_ajaran,
            'semester'        => $request->semester,
            'jumlah_sks'      => $request->jumlah_sks,
            'hari'            => $request->hari,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
            'ruangan'         => $request->ruangan,
            // 'user_id'         => '123' // Ambil ID user yang login secara otomatis
        ]);

        return redirect()->route('jadwal-ngajar')->with('success', 'Jadwal kelas berhasil ditambahkan!');
    }

    public function detailKelas($id)
    {
        $data = [
            'title'             => 'Detail Kelas',
            'activeJadwal'       => 'active',
            'data'              => Kelas::findOrFail($id),
        ];

        return view('dosen.jadwal.detail-kelas', $data);
    }


}