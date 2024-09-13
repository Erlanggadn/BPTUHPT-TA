<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModHargaRumput extends Model
{
    use HasFactory;
    protected $table = 'master_harga_rumput';
    protected $primaryKey = 'hr_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'hr_id',
        'rum_id',
        'hr_jenis',
        'hr_satuan',
        'hr_kategori',
        'hr_harga',
    ];
    public function jenis()
    {
        return $this->belongsTo(ModJenisRumput::class, 'rum_id', 'rum_id');
    }
}
