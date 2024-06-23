<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModJenisKandang extends Model
{
    use HasFactory;

    protected $table = 'master_kandang_jenis';
    protected $primaryKey = 'kandang_id';
    public $timestamps = true;

    protected $fillable = [
        'kandang_kode',
        'kandang_nama',
        'kandang_tipe',
        'kandang_keterangan',
        'kandang_aktif',
        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];

    public function jenisKandang()
    {
        return $this->hasMany(ModSapi::class, 'kandang_jenis', 'kandang_id');
    }
}
