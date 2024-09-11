<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ModPegawai;
use Illuminate\Support\Str;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        // Dapatkan semua pengguna dengan role selain 'pembeli'
        $users = User::where('role', '!=', 'pembeli')->get();

        foreach ($users as $index => $user) {
            ModPegawai::create([
                'pegawai_id' => 'PGW' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'user_id' => $user->user_id,
                'pegawai_nip' => '1234567890' . $index,
                'pegawai_nama' => 'Nama Pegawai ' . ($index + 1),
                'pegawai_alamat' => 'Alamat Pegawai ' . ($index + 1),
                'pegawai_nohp' => '08123456789' . $index,
            ]);
        }
    }
}
