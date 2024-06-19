<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModJenisSapi extends Model
{
    use HasFactory;

    protected $table = 'master_sapi_jenis';
    protected $primaryKey = 'sjenis_id';
    public $timestamps = true;

    protected $fillable = [
        'sjenis_kode',
        'sjenis_nama',
        'sjenis_keterangan',
        'sjenis_aktif',
        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];
}
