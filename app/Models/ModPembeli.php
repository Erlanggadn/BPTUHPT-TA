<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModPembeli extends Model
{
    use HasFactory;
    protected $table = 'pembeli';
    protected $primaryKey = 'pembeli_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pembeli_id',
        'user_id',
        'pembeli_instansi',
        'pembeli_lahir',
        'pembeli_nama',
        'pembeli_alamat',
        'pembeli_nohp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
    public function sapi()
    { 
        return $this->hasMany(ModPengajuanSapi::class, 'pembeli_id', 'pembeli_id');
    }
}
