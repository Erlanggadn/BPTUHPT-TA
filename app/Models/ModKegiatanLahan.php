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
        'pegawai_id',
        'rumput_id',
        'lahan_id',
        'tanam_tanggal',
        'tanam_jam_mulai',
        'tanam_jam_selesai',
        'tanam_kegiatan',
        'tanam_status',
        'tanam_foto',
    ];

    public function rumput()
    {
        return $this->belongsTo(ModRumput::class, 'rumput_id', 'rumput_id');
    }

    public function lahan()
    {
        return $this->belongsTo(ModJenisLahan::class, 'lahan_id', 'lahan_id');
    }
    public function pegawai()
    {
        return $this->belongsTo(ModPegawai::class, 'pegawai_id', 'pegawai_id');
    }
}
