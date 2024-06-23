<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345');

        DB::table('users')->insert([
            [
                'role' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'alamat' => 'Alamat Admin',
                'nohp' => '1234567890',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'pembeli',
                'name' => 'Pembeli',
                'email' => 'pembeli@gmail.com',
                'alamat' => 'Alamat Pembeli',
                'nohp' => '1234567890',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'wasbitnak',
                'name' => 'Wasbitnak',
                'email' => 'wasbitnak@gmail.com',
                'alamat' => 'Alamat Wasbitnak',
                'nohp' => '1234567890',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'keswan',
                'name' => 'Keswan',
                'email' => 'keswan@gmail.com',
                'alamat' => 'Alamat Keswan',
                'nohp' => '1234567890',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'ppid',
                'name' => 'Ppid',
                'email' => 'ppid@gmail.com',
                'alamat' => 'Alamat Ppid',
                'nohp' => '1234567890',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'kepala',
                'name' => 'Kepala',
                'email' => 'kepala@gmail.com',
                'alamat' => 'Alamat Kepala',
                'nohp' => '1234567890',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'bendahara',
                'name' => 'Bendahara',
                'email' => 'bendahara@gmail.com',
                'alamat' => 'Alamat Bendahara',
                'nohp' => '1234567890',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'wastukan',
                'name' => 'Wastukan',
                'email' => 'wastukan@gmail.com',
                'alamat' => 'Alamat Wastukan',
                'nohp' => '1234567890',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
