<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ModSapi;
use Carbon\Carbon;

class UpdateSapiUmur extends Command
{
    protected $signature = 'update:sapi_umur';
    protected $description = 'Update umur sapi setiap hari';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sapis = ModSapi::all();
        foreach ($sapis as $sapi) {
            $sapi->sapi_umur = Carbon::parse($sapi->sapi_tanggal_lahir)->diffInMonths(Carbon::now());
            $sapi->save();
        }
        $this->info('Umur sapi berhasil diperbarui');
    }
}
