<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModPengajuanRumput extends Model
{
    use HasFactory;
    protected $table = 'master_pengajuan_rumput';
    protected $primaryKey = 'belirum_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'belirum_id',
        'belirum_orang',
        'belirum_nohp',
        'belirum_alamat',
        'belirum_surat',
        'belirum_tanggal',
        'belirum_alasan',
        'belirum_status',
        'belirum_keterangan'
    ];

    public function pembeli()
    {
        return $this->belongsTo(ModPembeli::class, 'belirum_orang', 'pembeli_id');
    }
    public function detailPengajuanRumput()
    {
        return $this->hasMany(ModDetailPengajuanRumput::class, 'drumput_pengajuan', 'belirum_id');
    }
    public function pembayaranRumput()
    {
        return $this->hasMany(ModPembayaranRumput::class, 'bayarrum_beli', 'belirum_id');
    }
    public function getDisplayStatusAttribute()
    {
        $statuses = ['Diproses', 'Disetujui', 'Ditolak'];

        if (in_array($this->belirum_status, $statuses)) {
            return $this->belirum_status;
        }

        return 'Diproses';
    }
}
