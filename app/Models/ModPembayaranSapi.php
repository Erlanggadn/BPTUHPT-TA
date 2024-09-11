<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModPembayaranSapi extends Model
{
    use HasFactory;
    protected $table = 'master_pembayaran_sapi';
    protected $primaryKey = 'dbeli_id';
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'dbeli_id',
        'belisapi_id',
        'dbeli_invoice',
        'dbeli_bukti',
        'dbeli_sudah',
        'dbeli_status',
        'dbeli_keterangan',
    ];

    public function PengajuanSapi()
    {
        return $this->belongsTo(ModPengajuanSapi::class, 'belisapi_id', 'belisapi_id');
    }
}
