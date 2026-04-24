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
        // dd($request->all());
        $user = Auth::user();

        $rules = [
            'nama'          => 'required|string|max:255',
            'email'         => 'required|email',
            'jenis_kelamin' => 'required|string',
            'jurusan'       => 'required|string',
            'angkatan'      => 'required|string',
            'alamat'        => 'nullable|string',
        ];

        if ($user->role_id == 1) {
        // Jika Admin/Dosen, NIDN wajib, nim abaikan
            $rules['NIDN'] = 'required|integer';
        } else {
            // Jika Mahasiswa, NIM wajib, NIDN abaikan
            $rules['nim']      = 'required|string'; // Ubah ke string jika nim ada karakter/panjang
            $rules['jurusan']  = 'required|string'; // PASTIKAN INI STRING, bukan integer
            $rules['angkatan'] = 'required|string';
        }

        $request->validate($rules, [
            'nama.required'          => 'Nama tidak boleh kosong.',
            'jurusan.required'       => 'Jurusan tidak boleh kosong.',
            'angkatan.required'      => 'Angkatan tidak boleh kosong.',
            'email.required'         => 'Email tidak boleh kosong.',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong.',
            'nim.required'           => 'NIM tidak boleh kosong.',
            'NIDN.required'          => 'NIDN tidak boleh kosong.',
        ]);

        $updateData = [
            'nama'          => $request->nama,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        if ($user->role_id == 1) {
            $updateData['NIDN'] = $request->NIDN;
        }

        // Update tabel Users
        $user->update($updateData);

        // 5. Update tabel Mahasiswa (lewat relasi)
        if ($user->role_id != 1 && $user->mahasiswa) {
            $user->mahasiswa->update([
                'nim'      => $request->nim,
                'jurusan'  => $request->jurusan,
                'angkatan' => $request->angkatan,
            ]);
        }

        return back()->with('success', 'Profil Anda berhasil diperbarui!');
    }

    
}