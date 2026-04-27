<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Mahasiswa;
use App\Models\MasterRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   
    protected $fillable = [
        'nama',
        'email',
        'phone',
        'password',
        'role_id',
        'NIDN',
        'jenis_kelamin',
        'alamat'
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    public function role() 
    {
        return $this->belongsTo(MasterRole::class, 'role_id');
    }
    
    public function pengumumans()
    {
        // Satu user bisa membuat banyak pengumuman
        return $this->hasMany(Pengumuman::class);
    }
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}