<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanSapi extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_sapi';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kegiatan', 'kode_sapi'];

    public function kegiatanKandang()
    {
        return $this->belongsTo(KegiatanKandang::class, 'id_kegiatan', 'id_kegiatan');
    }

    public function sapi()
    {
        return $this->belongsTo(Sapi::class, 'kode_sapi', 'id');
    }
}
