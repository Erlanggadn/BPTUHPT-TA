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
    ];

    public function details()
    {
        return $this->hasMany(ModDetailPengajuanSapi::class, 'detail_pengajuan', 'belisapi_id');
    }

    public function user()
    {
        return $this->belongsTo(ModPembeli::class, 'belisapi_orang', 'pembeli_id');
    }
    public function pembayaranSapi()
    {
        return $this->hasMany(ModPembayaranSapi::class, 'dbeli_beli', 'belisapi_id');
    }
    public function getDisplayStatusAttribute()
    {
        $statuses = ['Diproses', 'Disetujui', 'Ditolak'];

        if (in_array($this->belisapi_status, $statuses)) {
            return $this->belisapi_status;
        }

        return 'Diproses';
    }
}
