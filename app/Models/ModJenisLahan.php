<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModJenisLahan extends Model
{
    use HasFactory;

    protected $table = 'master_lahan_jenis';
    protected $primaryKey = 'lahan_id';
    public $timestamps = true;

    protected $fillable = [
        'lahan_kode',
        'lahan_nama',
        'lahan_keterangan',
        'lahan_aktif',
        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];
}
