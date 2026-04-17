<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
    protected $table = 'master_role';
    protected $fillable = [
        'nama'
    ];

    public function users()
    {
        return $this->hashMany(User::class);
    }
}