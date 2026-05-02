<?php

namespace App\Http\Controllers\dosen;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaGroupController extends Controller
{
    public function index(Request $request, $id) 
    {
        // 1. Ambil data Kelas, tapi relasi 'mahasiswas' kita filter di dalam query-nya
        $kelas = Kelas::with(['mahasiswas' => function($query) use ($request) {
            
            // Filter berdasarkan Nama atau NIM atau Email (melalui relasi user)
            if ($request->filled('cari')) {
                $cari = $request->cari;
                $query->where(function($q) use ($cari) {
                    $q->where('nim', 'LIKE', "%$cari%")
                    ->orWhereHas('user', function($userQuery) use ($cari) {
                        $userQuery->where('nama', 'LIKE', "%$cari%")
                                    ->orWhere('email', 'LIKE', "%$cari%");
                    });
                });
            }

            // Filter berdasarkan Angkatan
            if ($request->filled('angkatan')) {
                $query->where('angkatan', $request->angkatan);
            }

            // Filter berdasarkan Jenis Kelamin
            if ($request->filled('jenis_kelamin')) {
                $query->where('jenis_kelamin', $request->jenis_kelamin);
            }

        }, 'mahasiswas.user'])->findOrFail($id);

        // dd($kelas);

        // 2. Bungkus data untuk dikirim ke view
        $data = [
            'title'           => 'Absensi Management Kelas',
            'data'            => $kelas,
            'activeManagemen' => 'active',
        ];

        return view('dosen.managemen-kelas.mahasiswa.index', $data);
    }

    public function addProccess(Request $request, $kelas_id)
    {
   
        // dd($request->all());
        $request->validate([
            'nim'               => 'required|unique:mahasiswa,nim',
            'nama'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'jenis_kelamin'     => 'required|in:L,P',
            'angkatan'          => 'required',
            'jurusan'           => 'required',
        ], 
        // [
        //     'periode.required'          => 'Periode Tahun tidak boleh kosong',
        //     'tahun_ajaran'              => 'Tahun ajaran tidak boleh kosong',
        //     'nama_matakuliah.required'  => 'Nama Mata Kuliah tidak boleh kosong',
        //     'hari.required'             => 'Hari tidak boleh kosong',
        //     'jam_mulai.required'        => 'Jam mulai tidak boleh kosong',
        //     'jam_selesai.required'      => 'Jam selesai tidak boleh kosong',
        //     'semester.required'         => 'Semester tidak boleh kosong',
        // ]
        );

        // Gunakan Transaction agar jika salah satu gagal, semua dibatalkan (aman)
        DB::beginTransaction();

        try {
            // 2. Simpan ke Tabel Users (Untuk Login)
            
            $user = User::create([
                'nama'              => $request->nama,
                'email'             => $request->email,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'password'          => Hash::make($request->nim), // Password default = NIM
                'role_id'           => 3, // Asumsi ID 2 adalah role mahasiswa
            ]);

            // 3. Simpan ke Tabel Mahasiswa (Profil)
            $mahasiswa = Mahasiswa::create([
                'user_id'       => $user->id,
                'nim'           => $request->nim,
                'jurusan'       => $request->jurusan,
                'angkatan'      => $request->angkatan,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            // 4. Hubungkan ke Tabel Pivot (kelas_mahasiswas)
            $kelas = Kelas::findOrFail($kelas_id);
            $kelas->mahasiswas()->attach($mahasiswa->id);

            DB::commit();

            return back()->with('success', 'Mahasiswa ' . $request->nama . ' berhasil didaftarkan!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function editProccess(Request $request, $id)
    {
       
        $request->validate([
            'nim'               => 'nullable',
            'nama'              => 'nullable',
            'email'             => 'nullable',
            'jenis_kelamin'     => 'nullable',
            'angkatan'          => 'nullable',
            'phone'             => 'nullable',
        ]);

        DB::beginTransaction();
        
        try{
            $mahasiswa = Mahasiswa::findOrFail($id);
            $user = $mahasiswa->user;
            
            $user->update([
                'nama'          => $request->nama,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            // dd($user->getChanges());

            
            // Update data Mahasiswa (Tanpa IF role_id agar lebih pasti jalan)
            $mahasiswa->update([
                'nim'       => $request->nim,
                'angkatan'  => $request->angkatan,
            ]);

            // dd($mahasiswa);
            DB::commit();
            return redirect()->route('anggota-group-index', $mahasiswa->kelas_id)
            ->with('success', 'Data berhasil diubah');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $userId = $mahasiswa->user_id;
            $mahasiswa->delete();
            $user = User::findOrFail($userId);
            $user->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Akun dan Data Mahasiswa berhasil dihapus permanen.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}