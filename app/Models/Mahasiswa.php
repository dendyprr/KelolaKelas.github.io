<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{

    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim',
        'user_id',
        'kelas_id',
        'jurusan',
        'angkatan',
        'jenis_kelamin'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        // Cukup ini saja, jangan tambahkan user_id di withPivot
        return $this->belongsToMany(Kelas::class, 'kelas_mahasiswas', 'mahasiswa_id', 'kelas_id');
    }

    public function nilai()
    {
        return $this->hasOne(InputNilai::class, 'mahasiswa_id');
    }

    public function absensis() {
        return $this->hasMany(Absensi::class);
    }

    // 1. Hitung Rata-rata Nilai Tugas
    public function getRataTugasAttribute() {
        // Mengambil rata-rata kolom 'nilai_tugas' dari relasi absensi
        return $this->absensis()->avg('nilai_tugas') ?? 0;
    }

    // 2. Hitung Total Alpa
    public function getTotalAlpaAttribute() {
        return $this->absensis()->where('status', 'Alpa')->count();
    }

    // 3. Cek Kelulusan Absen (Contoh: Tidak boleh Alpa > 3)
    public function getIsLulusAbsenAttribute() {
        return $this->total_alpa <= 3;
    }
}