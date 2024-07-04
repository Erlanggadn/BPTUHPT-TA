<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModDetailPengajuanSapi extends Model
{
    use HasFactory;
    protected $table = 'detail_pengajuan_sapi';
    protected $primaryKey = 'detail_id';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'detail_id',
        'detail_pengajuan',
        'detail_jenis',
        'detail_kategori',
        'detail_jumlah',
        'detail_kelamin',
    ];


    public function pengajuan()
    {
        return $this->belongsTo(ModPengajuanSapi::class, 'detail_pengajuan', 'belisapi_id');
    }

    public function sapiJenis()
    {
        return $this->belongsTo(ModJenisSapi::class, 'detail_jenis', 'sjenis_id');
    }
}
