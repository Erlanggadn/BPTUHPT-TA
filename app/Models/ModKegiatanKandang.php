<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModKegiatanKandang extends Model
{
    use HasFactory;
    protected $table = 'master_kegiatan_kandang';
    protected $primaryKey = 'kegiatan_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kegiatan_id',
        'kand_id',
        'pegawai_id',
        'kegiatan_tanggal',
        'kegiatan_jam_mulai',
        'kegiatan_jam_selesai',
        'kegiatan_keterangan',
        'kegiatan_status',
        'kegiatan_foto',
    ];
    public function kandang()
    {
        return $this->belongsTo(ModKandang::class, 'kand_id', 'kand_id');
    }

    public function detailKandangSapis()
    {
        return $this->hasMany(ModDetailKandangSapi::class, 'kegiatan_id', 'kegiatan_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(ModPegawai::class, 'pegawai_id', 'pegawai_id');
    }
}
