<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModJenisKandang extends Model
{
    use HasFactory;

    protected $table = 'master_kandang_jenis';
    protected $primaryKey = 'kandang_id';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'kandang_id',
        'kandang_tipe',
        'kandang_keterangan',
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
