<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModKandang extends Model
{
    use HasFactory;
    protected $table = 'master_kandang';
    protected $primaryKey = 'kand_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'kand_id',
        'kand_nama',
        'kand_kode',
        'kandang_id',
        'kand_keterangan',
        'kand_aktif',
    ];

    public function jenisKandang()
    {
        return $this->belongsTo(ModJenisKandang::class, 'kandang_id', 'kandang_id');
    }
    public function kegiatanKandangs()
    {
        return $this->hasMany(ModKegiatanKandang::class, 'kand_id', 'kand_id');
    }
}
