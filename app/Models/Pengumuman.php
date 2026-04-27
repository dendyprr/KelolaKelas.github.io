<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'target',
        'file',
        'is_urgent'
    ];

    public function user()
    {
        // Setiap pengumuman dimiliki oleh satu user (Admin/Dosen)
        return $this->belongsTo(User::class);
    }
}