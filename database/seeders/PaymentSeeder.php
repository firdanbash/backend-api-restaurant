<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'name' => 'Cash',
            'type' => 'Cash',
            'logo' => 'logo.png',
        ]);
        Payment::create([
            'name' => 'BRI',
            'type' => 'Transfer',
            'logo' => 'logo.png',
        ]);
        Payment::create([
            'name' => 'BCA',
            'type' => 'Transfer',
            'logo' => 'logo.png',
        ]);
        Payment::create([
            'name' => 'BNI',
            'type' => 'Transfer',
            'logo' => 'logo.png',
        ]);
        Payment::create([
            'name' => 'Mandiri',
            'type' => 'Transfer',
            'logo' => 'logo.png',
        ]);
    }
}
