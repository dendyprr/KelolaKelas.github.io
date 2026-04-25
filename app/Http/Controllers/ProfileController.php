<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'title'                 => 'Profile',
            'data'                  => User::with(['mahasiswa', 'role'])->findOrFail(auth()->id())
        ];

        return view('profile.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'data'  => User::with(['mahasiswa', 'role'])->findOrFail(auth()->id())
        ];

        return view('profile.edit', $data);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // 1. Definisikan Rule Validasi
        $rules = [
            'nama'          => 'required|string|max:255',
            'email'         => 'nullable|email',
            'jenis_kelamin' => 'required|string',
            'alamat'        => 'nullable|string',
            'phone'         => 'nullable|string',
        ];

        if ($user->role_id == 1) {
            $rules['NIDN'] = 'required|string';
        } else {
            $rules['nim']      = 'required|string';
            $rules['jurusan']  = 'required|string';
            $rules['angkatan'] = 'required|string';
        }

        // 2. Jalankan Validasi dengan Pesan Bahasa Indonesia
        $request->validate($rules, [
            // Pesan untuk Nama
            'nama.required'          => 'Nama lengkap tidak boleh kosong.',
            'nama.string'            => 'Format nama harus berupa teks.',
            'email.email'            => 'Format email yang Anda masukkan tidak valid.',
            
            // Pesan untuk Jenis Kelamin
            'jenis_kelamin.required' => 'Silakan pilih jenis kelamin Anda.',
            
            // Pesan untuk Mahasiswa (NIM, Jurusan, Angkatan)
            'nim.required'           => 'Nomor Induk Mahasiswa (NIM) wajib diisi.',
            'jurusan.required'       => 'Program studi/Jurusan tidak boleh kosong.',
            'angkatan.required'      => 'Tahun angkatan wajib diisi.',
            
            // Pesan untuk Dosen (NIDN)
            'NIDN.required'          => 'Nomor Induk Dosen (NIDN) tidak boleh kosong.',
        ]);

        try {
            // 3. Proses Update Tabel Users
            $user->update([
                'nama'          => $request->nama,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'alamat'        => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'NIDN'          => ($user->role_id == 1) ? $request->NIDN : $user->NIDN,
            ]);

            // 4. Proses Update Tabel Mahasiswa
            if ($user->role_id != 1 && $user->mahasiswa) {
                $user->mahasiswa->update([
                    'nim'      => $request->nim,
                    'jurusan'  => $request->jurusan,
                    'angkatan' => $request->angkatan,
                ]);
            }

            return back()->with('success', 'Profil Anda berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    
}