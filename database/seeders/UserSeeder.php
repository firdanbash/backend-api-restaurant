<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Symfony\Component\Clock\now;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Kasir Toko',
            'email' => 'kasir@kasir.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'kasir',
            'remember_token' => Str::random(10),
        ]);
    }
}
