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
        'rum_id',
        'rumput_berat_awal',
        'rumput_berat_hasil',
        'rumput_masuk',
        'rumput_keterangan',
        'rumput_status',
    ];

    public function jenisRumput()
    {
        return $this->belongsTo(ModJenisRumput::class, 'rum_id', 'rum_id');
    }
    public function kegiatanRumput()
    {
        return $this->hasMany(ModKegiatanLahan::class, 'rumput_id', 'rumput_id');
    }
}

