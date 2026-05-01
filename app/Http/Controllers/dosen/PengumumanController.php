<?php

namespace App\Http\Controllers\dosen;

use App\Models\Pengumuman;
use App\Models\User;
use App\Notifications\PengumumanBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    
    public function index()
    {
        $data = [
            'title'             => 'Pengumuman',
            'activePengumuman'  => 'active',
            'pengumumans'       => Pengumuman::with('user')->latest()->paginate(10),
        ];
        return view('dosen.pengumuman.index', $data);
    }
    
    public function add()
    {
        $data = [
            'title'                    => 'Tambah Pengumuman',
            'roles'                    => User::with('role')->distinct()->get(),
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
            'file'      => 'nullable|mimes:pdf,jpg,jpeg,png,ppt,pptx,doc,docx,xls,xlsx|max:5120',
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
                
                $path = $file->storeAs('pengumuman', $filename, 'public');
                
                $data['file'] = $filename;
            }

            // 3. Simpan ke Database
            $pengumuman = Pengumuman::create($data);

            if (in_array($request->target, ['0', '3'])) {
            $mahasiswas = User::where('role_id', 3)->get();
                Notification::send($mahasiswas, new PengumumanBaru($pengumuman));
            }
            
            // Arahkan kembali ke halaman index pengumuman
            return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil dipublikasikan!');

        } catch (\Exception $e) {
            // Jika gagal, hapus file yang terlanjur diupload (jika ada)
            if (isset($path)) {
                Storage::disk('public')->delete('pengumuman/' . $filename);
            }

            return back()->withInput()->with('error', 'Gagal menyimpan pengumuman: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // 1. Cari data pengumuman berdasarkan ID
        // Jika tidak ketemu, otomatis lempar error 404
        $pengumuman = Pengumuman::with('user')->findOrFail($id);

        $data = [
            'title'            => 'Detail Pengumuman',
            'activePengumuman' => 'active',
            'item'             => $pengumuman, // Kita pakai variabel 'item' agar sinkron dengan file Blade detail sebelumnya
        ];

        // 2. Arahkan ke file view detail
        // Pastikan Mas sudah buat file: resources/views/dosen/pengumuman/show.blade.php
        return view('dosen.pengumuman.show', $data);
    }   

    public function edit($id)
    {
        $data = [
            'title'             => 'Edit Pengumuman',
            'activePengumuman'  => 'active',
            'item'              => Pengumuman::findOrFail($id),
        ];
        return view('dosen.pengumuman.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $item = Pengumuman::findOrFail($id);
          
        $data = $request->only(['judul', 'isi', 'target']);
        $data['is_urgent'] = $request->has('is_urgent') ? 1 : 0;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($item->file) {
                Storage::disk('public')->delete('pengumuman/' . $item->file);
            }
            // Upload file baru
            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('pengumuman', $filename, 'public');
            $data['file'] = $filename;
        }

        $item->update($data);

        return redirect()->route('pengumuman.edit', $id)->with('success', 'Pengumuman berhasil diupdate!');
    }

    public function delete($id)
    {
        // $data = Pengumuman::firstOrFail($id);
        $data = Pengumuman::findOrFail($id);

        try{
            
            if($data->file){
                
                $filePath = 'pengumuman/' . $data->file;

                if(Storage::disk('public')->exists($filePath)){
                   Storage::disk('public')->delete($filePath);
                }
            }

            $data->delete();

            return redirect()->back()->with('success', 'Pengumuman dan lampirannya berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

}