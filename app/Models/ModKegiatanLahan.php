<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModKegiatanLahan extends Model
{
    use HasFactory;
    
    protected $table = 'master_kegiatan_lahan';
    protected $primaryKey = 'tanam_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tanam_id',
        'tanam_detail_rumput',
        'tanam_detail_lahan',
        'tanam_tanggal',
        'tanam_jam_mulai',
        'tanam_jam_selesai',
        'tanam_kegiatan',
        'tanam_status',
        'tanam_foto',

        'created_id',
        'created_nama',
        'updated_id',
        'updated_nama'
    ];

    public function rumput()
    {
        return $this->belongsTo(ModRumput::class, 'tanam_detail_rumput', 'rumput_id');
    }

    public function lahan()
    {
        return $this->belongsTo(ModJenisLahan::class, 'tanam_detail_lahan', 'lahan_id');
    }
}
