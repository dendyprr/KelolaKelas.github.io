<?php

namespace App\Http\Controllers\dosen;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanPresensiController extends Controller
{
    public function index($id)
    {
        $kelas = Kelas::findOrFail($id);
        $pertemuans = Pertemuan::where('kelas_id', $id)
            ->withCount([
                'absensi as total_mhs',
                'absensi as hadir_count' => function ($query) {
                    $query->where('status', 'Hadir');
                }
            ])
            ->orderBy('pertemuan_ke', 'asc')
            ->get();

        $data = [
            'activeManagemen'       => 'active',
            'title'                 => 'Daftar Pertemuan - ' . $kelas->nama_matakuliah,
            'kelas_id'              => $id,
            'kelas'                 => $kelas,       // Data kelas untuk Header
            'pertemuans'            => $pertemuans   // Data untuk Looping Card
        ];

        return view('dosen.managemen-kelas.pertemuan.index', $data);
    }

    public function addProccess(Request $request, $id) 
    {
        // Hitung ada berapa pertemuan di kelas ini sekarang, lalu tambah 1
        $pertemuanKe = Pertemuan::where('kelas_id', $id)->count() + 1;

       $pertemuan = Pertemuan::create([
            'kelas_id'     => $id,
            'pertemuan_ke' => $pertemuanKe, // Jadi otomatis urut
            'tanggal'      => $request->tanggal,
            'materi'       => $request->materi,
        ]);

        $mahasiswas = Mahasiswa::where('kelas_id', $id)->get();
        // dd($mahasiswas);

        foreach ($mahasiswas as $mhs) {
            Absensi::create([
                'pertemuan_id' => $pertemuan->id,
                'mahasiswa_id' => $mhs->id,
                'status'       => 'Hadir', // Default set Hadir biar dosen tinggal ubah yang absen saja
                'keterangan'   => '-',
            ]);
        }

        return redirect()->route('pertemuan-presensi-index', $id)->with('success', 'Pertemuan berhasil ditambah!');
    }

    public function addFormPresensi($id) 
    {

        $pertemuan_info = Pertemuan::findOrFail($id);
        $absensi = Absensi::with('mahasiswa.user')
                    ->where('pertemuan_id', $id)
                    ->get();

        $data = [
            'title'           => 'Form Presensi Mahasiswa',
            'activeManagemen' => 'active',
            'pertemuan'       => $pertemuan_info, // Objek pertemuan
            'absensi'         => $absensi,        // Koleksi data absen
            'kelas_id'        => $pertemuan_info->kelas_id
        ];

        return view('dosen.managemen-kelas.pertemuan.add-form-presensi', $data);
    }

    public function updatePresensi(Request $request, $id)
    {
        // $id di sini adalah ID Pertemuan
        
        // 1. Validasi input (opsional tapi disarankan)
        $request->validate([
            'status' => 'required|array',
        ]);

        try {
            $pertemuan = Pertemuan::findOrFail($id);
            $pertemuan->update([
                'materi' => $request->materi,
                'tanggal' => $request->tanggal,
                'catatan' => $request->catatan, // Tambahkan ini
            ]);
            
            foreach ($request->absen_id as $key => $absen_id) {
                $absen = Absensi::find($absen_id);
                $absen->update([
                    'status' => $request->status[$absen->id],
                    'keterangan' => $request->keterangan[$absen->id],
                    'nilai_tugas' => $request->nilai_tugas[$absen->id] ?? 0,
                ]);
            }

            // 3. Ambil data pertemuan untuk dapet kelas_id (biar bisa redirect balik)
            $pertemuan = Pertemuan::findOrFail($id);

            return redirect()->route('pertemuan-presensi-form', $pertemuan->id)
                         ->with('success', 'Presensi berhasil disimpan!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan presensi: ' . $e->getMessage());
        }
    }

    public function maintenance()
    {
        $data = [
            'title'                     => 'Presensi QR Code',
            'activePresensiQRCode'      => 'active',
        ];
        
        return view('maintenance', $data);
    }
}