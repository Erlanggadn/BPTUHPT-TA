<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModDetailKandangSapi extends Model
{
    use HasFactory;

    protected $table = 'master_detail_kandang_sapi';
    protected $primaryKey = 'detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'detail_id',
        'detail_kandang',
        'detail_sapi',
        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->{$model->getKeyName()} = (string) Str::uuid();
    //     });
    // }

    public function kegiatanKandang()
    {
        return $this->belongsTo(ModKegiatanKandang::class, 'detail_kandang', 'kegiatan_id');
    }

    public function sapi()
    {
        return $this->belongsTo(ModSapi::class, 'detail_sapi', 'sapi_id');
    }
}
