<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wastukan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nomor_lahan',
        'kode_pakan',
        'tanggal_tanam',
        'tanggal_panen',
        'kegiatan',
        'berat',
        'status',
        'pesan'
    ];

    public function rumput()
    {
        return $this->belongsTo(rumput::class, 'kode_pakan', 'kode_rumput');
    }
}
