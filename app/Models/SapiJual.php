<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SapiJual extends Model
{
    use HasFactory;

    protected $table = 'sapi_juals';
    protected $primaryKey = 'id_jual';

    protected $fillable = [
        'kode_sapi',
        'jenis_sapi',
        'status',
        'tgl_siap',
        
    ];

    public function sapi()
    {
        return $this->belongsTo(Sapi::class, 'kode_sapi', 'id');
    }
}

