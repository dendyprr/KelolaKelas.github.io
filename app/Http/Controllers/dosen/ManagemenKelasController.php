<?php

namespace App\Http\Controllers\dosen;

use App\Models\Kelas;
use Illuminate\Http\Request;

class ManagemenKelasController extends Controller
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
            'title'           => 'Management Kelas',
            'activeManagemen' => 'active',
            'data'            => $jadwal,
            'hasFilter'       => $hasFilter,
            'filter_periode'  => $filter_periode,
            'filter_tahun'    => $filter_tahun,
        ];

        return view('dosen.managemen-kelas.index', $data);
    }

    public function add()
    {
        $data = [
            'title'                 => 'Tambah Kelas Baru',
            'activeManagemen'       => 'active',
        ];
        return view('dosen.managemen-kelas.add', $data);    
    }

    public function addProccess(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode_kelas'        => 'nullable', // Tambah unique
            'nama_matakuliah'   => 'required',
            'jumlah_sks'        => 'nullable|numeric',
            'semester'          => 'required|numeric',
            'tahun_ajaran'      => 'required|numeric',
            'periode'           => 'required',
            'hari'              => 'required',
            'jam_mulai'         => 'required',
            'jam_selesai'       => 'required',
            'ruangan'           => 'nullable',
        ], [
            'periode.required'          => 'Periode Tahun tidak boleh kosong',
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

        return redirect()->route('manajement-kelas')->with('success', 'Jadwal kelas berhasil ditambahkan!');
    }

    public function ubahJadwal($id)
    {
        $data = [
            'title'             => 'Ubah Jadwal Kelas',
            'activeManagemen'   => 'active',
            'data'              => Kelas::findOrFail($id),
        ];

        return view('dosen.managemen-kelas.edit-jadwal', $data);
    }

    public function ubahJadwalProccess(Request $request, $id)
    {
        $data = $request->validate([
            'kode_kelas'        => 'nullable|unique:kelas,kode_kelas,'.$id,
            'nama_matakuliah'   => 'required',
            'jumlah_sks'        => 'required|numeric',
            'semester'          => 'required|numeric',
            'tahun_ajaran'      => 'required|numeric',
            'periode'           => 'required',
            'hari'              => 'required',
            'jam_mulai'         => 'required',
            'jam_selesai'       => 'required',
            'ruangan'           => 'required',
        ]);
        
        $result = Kelas::findOrFail($id);
        $result->update($data);

        return redirect()->route('ubah-jadwal-manajement-kelas', $id)->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function detailKelas(Request $request,$id)
    {
        $data = [
            'title'             => 'Detail Management Kelas',
            'activeManagemen'   => 'active',
            'data'              => Kelas::findOrFail($id),
            'filter_periode'    => $request->query('filter_periode'),
            'filter_tahun'      => $request->query('filter_tahun'),
        ];

        return view('dosen.managemen-kelas.detail-kelas', $data);
    }

    public function hapusKelas($id)
    {
        $data = Kelas::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Jadwal kelas berhasil dihapus!');
    }

    public function resetFilter()
    {
        session()->forget(['filter_periode', 'filter_tahun']);
        return redirect()->route('manajement-kelas');
    }
     
}