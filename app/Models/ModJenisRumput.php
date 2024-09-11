<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModJenisRumput extends Model
{
    use HasFactory;
    protected $table = 'master_rumput_jenis';
    protected $primaryKey = 'rum_id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'rum_id',
        'rum_nama',
        'rum_keterangan',
    ];

    public function rumput()
    {
        return $this->hasMany(ModRumput::class, 'rum_id', 'rum_id');
    }
}
