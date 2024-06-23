<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModJenisSapi extends Model
{
    use HasFactory;

    protected $table = 'master_sapi_jenis';
    protected $primaryKey = 'sjenis_id';
    public $incrementing = false; // since the primary key is not an integer
    public $timestamps = true;

    protected $fillable = [
        'sjenis_id',
        'sjenis_nama',
        'sjenis_keterangan',

        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];

    public function sapi()
    {
        return $this->hasMany(ModSapi::class, 'sapi_jenis', 'sjenis_id');
    }
}
