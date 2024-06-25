<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModKegiatanKandang extends Model
{
    use HasFactory;

    protected $table = 'master_kegiatan_kandang';
    protected $primaryKey = 'kegiatan_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kegiatan_id',
        'kegiatan_jenis_kandang',
        'kegiatan_tanggal',
        'kegiatan_jam_mulai',
        'kegiatan_jam_selesai',
        'kegiatan_keterangan',
        'kegiatan_status',
        'kegiatan_foto',

        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama'
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->{$model->getKeyName()} = (string) Str::uuid();
    //     });
    // }

    public function kandang()
    {
        return $this->belongsTo(ModKandang::class, 'kegiatan_jenis_kandang', 'kand_id');
    }

    public function detailKandangSapis()
    {
        return $this->hasMany(ModDetailKandangSapi::class, 'detail_kandang', 'kegiatan_id');
    }
}
