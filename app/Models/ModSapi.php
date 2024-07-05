<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\ModJenisSapi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSapi extends Model
{
    use HasFactory;

    protected $table = 'master_sapi';
    protected $primaryKey = 'sapi_id'; 
    protected $keyType = 'string'; 
    public $incrementing = false; 
    protected $fillable = [
        'sapi_jenis',
        'sapi_urutan_lahir',
        'sapi_tanggal_lahir',
        'sapi_no_induk',
        'sapi_keterangan',
        'sapi_kelamin',
        'sapi_umur',
        'sapi_status',
    ];
    protected $dates = ['sapi_tanggal_lahir'];

    public function jenisSapi()
    {
        return $this->belongsTo(ModJenisSapi::class, 'sapi_jenis', 'sjenis_id');
    }

    public function getUmurAttribute()
    {
        return $this->sapi_tanggal_lahir->diffInMonths(Carbon::now());
    }

    public function detailKandangSapis()
    {
        return $this->hasMany(ModDetailKandangSapi::class, 'detail_sapi', 'sapi_id');
    }
}
