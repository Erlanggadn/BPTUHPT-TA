<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pembeli extends Authenticatable
{
    use HasFactory;

    protected $table = 'pembeli';
    public $incrementing = false;
    protected $primaryKey = 'id_pembeli'; // Ganti 'id' menjadi 'id_pembeli'
    protected $keyType = 'string';

    protected $fillable = [
        'id_pembeli', 'email', 'nama', 'no_hp', 'alamat', 'tanggal_lahir', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
