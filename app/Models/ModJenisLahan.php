<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModJenisLahan extends Model
{
    use HasFactory;
    protected $table = 'master_lahan_jenis';
    protected $primaryKey = 'lahan_id';
    public $incrementing = false; 
    public $timestamps = true;
    protected $fillable = [
        'lahan_id',
        'lahan_nama',
        'lahan_keterangan',
        'lahan_jenis_tanah',
        'lahan_ukuran',
        'lahan_aktif',
    ];
}
