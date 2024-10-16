<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat 5 user dengan role pembeli
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'email' => "pembeli{$i}@gmail.com",
                'role' => 'pembeli',
                'password' => Hash::make('12345'),
            ]);
        }

        // Buat 5 user dengan role selain pembeli
        $roles = ['admin', 'wasbitnak', 'keswan', 'ppid', 'kepala', 'bendahara', 'wastukan'];
        foreach ($roles as $index => $role) {
            User::create([
                'email' => "{$role}@gmail.com",
                'role' => $role,
                'password' => Hash::make('12345'),
            ]);
        }
    }
}
