<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModJenisRumput extends Model
{
    use HasFactory;

    protected $table = 'master_rumput_jenis';
    protected $primaryKey = 'rum_id';
    public $timestamps = true;

    protected $fillable = [
        'rum_kode',
        'rum_nama',
        'rum_keterangan',
        'rum_aktif',
        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama',
    ];

    public function rumput()
    {
        return $this->hasMany(ModRumput::class, 'rumput_jenis', 'rum_id');
    }
}
