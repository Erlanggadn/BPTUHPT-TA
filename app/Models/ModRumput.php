<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModRumput extends Model
{
    use HasFactory;

    protected $table = 'master_rumput';
    protected $primaryKey = 'rumput_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'rumput_id',
        'rumput_jenis',
        'rumput_kode',
        'rumput_berat',
        'rumput_masuk',
        'rumput_keterangan',
        'rumput_aktif',

        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];
    public function jenisRumput()
    {
        return $this->belongsTo(ModJenisRumput::class, 'rumput_jenis', 'rum_id');
    }
}
