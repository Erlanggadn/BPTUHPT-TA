<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModPegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $primaryKey = 'pegawai_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pegawai_id',
        'user_id',
        'pegawai_nip',
        'pegawai_nama',
        'pegawai_alamat',
        'pegawai_nohp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function kandang()
    {
        return $this->hasMany(User::class);
    }

    public function lahan()
    {
        return $this->hasMany(ModKegiatanLahan::class, 'pegawai_id', 'pegawai_id');
    }
}
