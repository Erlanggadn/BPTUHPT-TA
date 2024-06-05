<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rumput extends Model
{
    protected $table = 'rumputs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'jenis_rumput',
        'kode_rumput',
        'deskripsi_rumput'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest('id')->first();
            if ($latest) {
                $number = (int) substr($latest->id, 1) + 1;
                $model->id = 'R' . str_pad($number, 3, '0', STR_PAD_LEFT);
            } else {
                $model->id = 'R001';
            }
        });
    }
}

