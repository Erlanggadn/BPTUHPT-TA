<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryKandang extends Model
{
    use HasFactory;

    protected $table = 'history_kandang';
    protected $fillable = ['kode_sapi', 'kode_kandang', 'kegiatan', 'tanggal_mulai', 'tanggal_selesai'];

    public function sapi()
    {
        return $this->belongsTo(Sapi::class, 'kode_sapi', 'id');
    }

    public function jenisKandang()
    {
        return $this->belongsTo(JenisKandang::class, 'kode_kandang', 'id_kandang');
    }
}
