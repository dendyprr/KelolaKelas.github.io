<?php

namespace App\Http\Controllers\dosen;

use App\Models\Pengumuman;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    
    public function index()
    {
        $data = [
            'title'             => 'Pengumuman',
            'activePengumuman'  => 'active',
            'pengumumans'      => Pengumuman::with('user')->latest()->paginate(10),
        ];
        return view('dosen.pengumuman.index', $data);
    }
    
    public function add()
    {
        $data = [
            'title'             => 'Tambah Pengumuman',
            'pengumumans'              => Pengumuman::all(),
        ];
        return view('dosen.pengumuman.add', $data);
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul'     => 'required|string|max:255',
            'isi'       => 'required|string',
            'target'    => 'required|string',
            'file'      => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048', // Maks 2MB
            'is_urgent' => 'nullable|boolean',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'isi.required'   => 'Isi pengumuman tidak boleh kosong.',
            'file.mimes'     => 'Format file harus PDF, JPG, atau PNG.',
            'file.max'       => 'Ukuran file maksimal adalah 2MB.',
        ]);

        try {
            $data = $request->only(['judul', 'isi', 'target']);
            $data['user_id'] = Auth::id();
            $data['is_urgent'] = $request->has('is_urgent') ? true : false;

            // 2. Handling Upload File
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Buat nama file unik: timestamp_nama-asli.ekstensi
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                
                // Simpan ke folder: storage/app/public/pengumuman
                $path = $file->storeAs('pengumuman', $filename, 'public');
                
                $data['file'] = $filename;
            }

            // 3. Simpan ke Database
            Pengumuman::create($data);

            // Arahkan kembali ke halaman index pengumuman
            return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dipublikasikan!');

        } catch (\Exception $e) {
            // Jika gagal, hapus file yang terlanjur diupload (jika ada)
            if (isset($path)) {
                Storage::disk('public')->delete('pengumuman/' . $filename);
            }

            return back()->withInput()->with('error', 'Gagal menyimpan pengumuman: ' . $e->getMessage());
        }
    }

}