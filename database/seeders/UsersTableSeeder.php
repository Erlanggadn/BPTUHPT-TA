<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ModPegawai;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'pembeli', 'wasbitnak', 'keswan', 'ppid', 'kepala', 'bendahara', 'wastukan'];
        $password = Hash::make('12345');

        foreach ($roles as $index => $role) {
            $user = User::create([
                'role' => $role,
                'email' => $role . '@gmail.com',
                'password' => $password,
            ]);

            // Create related pegawai record if role is not 'pembeli'
            if ($role !== 'pembeli') {
                $pegawaiId = 'PGW' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
                ModPegawai::create([
                    'pegawai_id' => $pegawaiId,
                    'pegawai_detail' => $user->id,
                    'pegawai_nip' => 'NIP' . str_pad($index + 1, 6, '0', STR_PAD_LEFT),
                    'pegawai_nama' => ucfirst($role) . ' Name',
                    'pegawai_alamat' => 'Address for ' . ucfirst($role),
                    'pegawai_nohp' => '081234567' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                ]);
            }
        }
    }
}
