<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModPengajuanSapi extends Model
{
    use HasFactory;
    protected $table = 'master_pengajuan_sapi';
    protected $primaryKey = 'belisapi_id';
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'belisapi_id',
        'belisapi_orang',
        'belisapi_nohp',
        'belisapi_alamat',
        'belisapi_surat',
        'belisapi_tanggal',
        'belisapi_alasan',
        'belisapi_status',
        'belisapi_keterangan',
        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];

    public function details()
    {
        return $this->hasMany(ModDetailPengajuanSapi::class, 'detail_pengajuan', 'belisapi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'belisapi_orang', 'id');
    }
}
