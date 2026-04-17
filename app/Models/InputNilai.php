<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputNilai extends Model
{

    protected $table = 'input_nilais';
    protected $fillable = ['mahasiswa_id', 'kelas_id', 'tugas', 'uts', 'uas', 'nilai_akhir', 'grade'];

    

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}