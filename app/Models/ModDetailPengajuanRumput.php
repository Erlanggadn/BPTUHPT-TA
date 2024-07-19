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
        'drumput_pengajuan',
        'drumput_jenis',
        'drumput_kategori',
        'drumput_berat',
        'drumput_satuan'
    ];

    public function pengajuanRumput()
    {
        return $this->belongsTo(ModPengajuanRumput::class, 'drumput_pengajuan', 'belirum_id');
    }
    public function jenisRumput()
    {
        return $this->belongsTo(ModJenisRumput::class, 'drumput_jenis', 'rum_id');
    }
}
