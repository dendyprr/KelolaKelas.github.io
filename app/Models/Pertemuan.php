<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    protected $fillable = [
        'kelas_id',
        'pertemuan_ke',
        'tanggal',
        'materi',
        'catatan',
    ];

    public function absensi()
    {
        // Pastikan nama modelnya 'Absensi' dan foreign key-nya 'pertemuan_id'
        return $this->hasMany(Absensi::class, 'pertemuan_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}