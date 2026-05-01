<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\Pengumuman;
use App\Models\PengumumanMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanMahasiswaController extends Controller
{
    public function index()
    {
        $data = [
            'title'                     => 'Pengumuman',
            'activePengumuman'          => 'active',
            'pengumumans'               => Pengumuman::whereIn('target', [0, 3])
                                        ->latest()
                                        ->paginate(10),
        ];
        
        return view('mahasiswa.pengumuman.index', $data);  
    }
    
    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        // LOGIKA AGAR NOTIFIKASI TERBACA:
        // Cari notifikasi milik user ini yang punya data id pengumuman tersebut
        $notification = Auth::user()->unreadNotifications
                        ->where('data.id', $id)
                        ->first();

        if ($notification) {
            $notification->markAsRead(); // Ini yang bikin angka di lonceng hilang
        }

        $data = [
            'title'             => 'Detail Pengumuman',
            'activePengumuman'  => 'active',
            'item'              => $pengumuman,
        ];

        return view('mahasiswa.pengumuman.show', $data);
    }

    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah dibaca.');
    }
}