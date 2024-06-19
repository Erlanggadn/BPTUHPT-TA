<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sapi extends Model
{
    use HasFactory;

    protected $table = 'sapi';
    protected $primaryKey = 'id'; // Jika Anda ingin menetapkan nama kolom primary key secara eksplisit
    
    protected $keyType = 'string'; // Menentukan tipe data primary key

    public $incrementing = false; // Memberitahu Eloquent bahwa primary key tidak auto-incrementing
    
    protected $fillable = [
        'jenis',
        'urutan_lahir',
        'tanggal_lahir',
        'no_induk',
        'riwayat_penyakit'
    ];

}
