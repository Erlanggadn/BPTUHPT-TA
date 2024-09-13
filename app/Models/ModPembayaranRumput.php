<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModPembayaranRumput extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'master_pembayaran_rumput';
    protected $primaryKey = 'bayarrum_id';
    public $incrementing = false;
    protected $keyType = 'string';
    use SoftDeletes;
    protected $fillable = [
        'bayarrum_id',
        'belirum_id',
        'bayarrum_invoice',
        'bayarrum_bukti',
        'bayarrum_sudah',
        'bayarrum_status',
        'bayarrum_keterangan'
    ];

    public function pengajuanRumput()
    {
        return $this->belongsTo(ModPengajuanRumput::class, 'belirum_id', 'belirum_id');
    }
}
