<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi'; // Pastikan nama tabelnya sama dengan migration
    protected $fillable = 
    [
        'pertemuan_id', 
        'mahasiswa_id', 
        'status', 
        'keterangan',
        'nilai_tugas'
    ];
    

    // Relasi balik ke Pertemuan
    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id');
    }

    // Relasi ke Mahasiswa untuk ambil NIM, Jurusan, dll
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}