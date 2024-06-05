<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumputSiapJual extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'rumput_siap_jual';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'id_wastukan',
        'tanggal',
        'status',
    ];

    public function wastukan()
    {
        return $this->belongsTo(Wastukan::class, 'id_wastukan');
    }
}
