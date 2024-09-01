<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModHargaSapi extends Model
{
    use HasFactory;
    protected $table = 'master_harga_sapi';
    protected $primaryKey = 'hs_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'hs_id',
        'hs_jenis',
        'hs_kelamin',
        'hs_kategori',
        'hs_harga',
    ];
    public function jenis()
    {
        return $this->belongsTo(ModJenisSapi::class, 'hs_jenis', 'sjenis_id');
    }
}
