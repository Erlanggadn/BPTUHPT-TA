<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanKandang extends Model
{
    use HasFactory;

   
    protected $table = 'kegiatan_kandang';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = [
        'kode_kandang',
        'kegiatan',
        'status',
    ];

    public function sapi()
    {
        return $this->belongsToMany(Sapi::class, 'kegiatan_sapi', 'id_kegiatan', 'kode_sapi');
    }

    public function kegiatanSapi()
    {
        return $this->hasMany(KegiatanSapi::class, 'id_kegiatan', 'id_kegiatan');
    }
}
