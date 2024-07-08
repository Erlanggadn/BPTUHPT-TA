<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ModPembeli;
use Illuminate\Support\Str;

class PembeliSeeder extends Seeder
{
    public function run()
    {
        // Dapatkan semua pengguna dengan role 'pembeli'
        $users = User::where('role', 'pembeli')->get();

        foreach ($users as $index => $user) {
            ModPembeli::create([
                'pembeli_id' => 'PMB' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'pembeli_detail' => $user->id,
                'pembeli_instansi' => 'Instansi ' . ($index + 1),
                'pembeli_lahir' => now()->subYears(rand(20, 50)),
                'pembeli_nama' => 'Nama Pembeli ' . ($index + 1),
                'pembeli_alamat' => 'Alamat Pembeli ' . ($index + 1),
                'pembeli_nohp' => '08123456789' . $index,
            ]);
        }
    }
}
