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
        'belisapi_id',
        'sjenis_id',
        'detail_kategori',
        'detail_jumlah',
        'detail_berat',
        'detail_kelamin',
    ];


    public function pengajuan()
    {
        return $this->belongsTo(ModPengajuanSapi::class, 'belisapi_id', 'belisapi_id');
    }
    public function sapiJenis()
    {
        return $this->belongsTo(ModJenisSapi::class, 'sjenis_id', 'sjenis_id');
    }
}
