<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $data = [
            'title'                     => 'Pengaturan',
        ];

        return view('settings.index', $data);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|min:5|confirmed', 
        ], [
            // Custom Pesan Error (Bahasa Indonesia)
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required'     => 'Password baru wajib diisi.',
            'new_password.min'          => 'Password baru minimal harus 5 karakter.',
            'new_password.confirmed'    => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        // 2. Cek apakah Password Lama sesuai dengan di Database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }

        // 3. Update Password Baru (Gunakan Hash::make)
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        // 4. Kembali dengan pesan sukses
        return back()->with('success', 'Password berhasil diperbarui!');
    }
}