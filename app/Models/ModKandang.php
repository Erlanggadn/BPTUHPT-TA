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
        'kand.id',
        'kand_kode',
        'kand_jenis',
        'kand_keterangan',
        'kand_aktif',

        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];
    public function jenisKandang()
    {
        return $this->belongsTo(ModJenisKandang::class, 'kand_jenis', 'kandang_id');
    }
}
