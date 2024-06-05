<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKandang extends Model
{
    use HasFactory;

    protected $table = 'jenis_kandang';
    protected $primaryKey = 'id_kandang';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_kandang', 'no_kandang', 'jenis_kandang', 'status'];

    public function kegiatanKandang()
    {
        return $this->hasMany(KegiatanKandang::class, 'kode_kandang', 'id_kandang');
    }

    public function historyKandang()
    {
        return $this->hasMany(HistoryKandang::class, 'kode_kandang', 'id_kandang');
    }
}
