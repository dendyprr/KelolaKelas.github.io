<?php

namespace App\Models;

use App\Models\Pertemuan;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'kode_kelas',
        'nama_matakuliah',
        'jumlah_sks',
        'periode',
        'tahun_ajaran',
        'semester',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        // 'user_id'
    ];

    public function pertemuans()
    {
        return $this->hasMany(Pertemuan::class, 'kelas_id');
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'kelas_mahasiswas', 'kelas_id', 'mahasiswa_id');
    }   

    public function dosen()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}