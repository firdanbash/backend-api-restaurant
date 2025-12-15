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
        $payments = [
            ['name' => 'Cash', 'type' => 'cash', 'logo' => 'cash.png'],
            ['name' => 'Bank BCA', 'type' => 'transfer', 'logo' => 'bca.png'],
            ['name' => 'Bank Mandiri', 'type' => 'transfer', 'logo' => 'mandiri.png'],
            ['name' => 'Bank BRI', 'type' => 'transfer', 'logo' => 'bri.png'],
            ['name' => 'QRIS', 'type' => 'transfer', 'logo' => 'qris.png'],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
