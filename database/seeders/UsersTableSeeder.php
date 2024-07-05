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
        $roles = ['admin', 'pembeli', 'wasbitnak', 'keswan', 'ppid', 'kepala', 'bendahara', 'wastukan'];
        $password = Hash::make('12345');

        foreach ($roles as $role) {
            DB::table('users')->insert([
                'role' => $role,
                'email' => $role . '@gmail.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
