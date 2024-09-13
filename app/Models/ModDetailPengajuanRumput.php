<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModDetailPengajuanRumput extends Model
{
    use HasFactory;
    protected $table = 'detail_pengajuan_rumput';
    protected $primaryKey = 'drumput_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'drumput_id',
        'belirum_id',
        'rum_id',
        'drumput_kategori',
        'drumput_berat',
        'drumput_satuan'
    ];

    public function pengajuanRumput()
    {
        return $this->belongsTo(ModPengajuanRumput::class, 'belirum_id', 'belirum_id');
    }
    public function jenisRumput()
    {
        return $this->belongsTo(ModJenisRumput::class, 'rum_id', 'rum_id');
    }
}
