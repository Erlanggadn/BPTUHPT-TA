<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModSapi extends Model
{
    use HasFactory;

    protected $table = 'master_sapi';
    protected $primaryKey = 'sapi_id'; 
    protected $keyType = 'string'; 
    public $incrementing = false; 
    protected $fillable = [
        'sapi_jenis',
        'sapi_urutan_lahir',
        'sapi_tanggal_lahir',
        'sapi_no_induk',
        'sapi_keterangan',
        
        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];
    public function jenisSapi()
    {
        return $this->belongsTo(ModJenisSapi::class, 'sapi_jenis', 'sjenis_id');
    }
}
