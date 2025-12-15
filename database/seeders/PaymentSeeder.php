<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            // E-Wallets
            [
                'name' => 'GoPay',
                'type' => 'cash',
                'logo' => 'Gopay (Alt).png',
            ],
            [
                'name' => 'DANA',
                'type' => 'cash',
                'logo' => 'DANA.png',
            ],
            [
                'name' => 'ShopeePay',
                'type' => 'cash',
                'logo' => 'ShopeePay.png',
            ],
            [
                'name' => 'LinkAja',
                'type' => 'cash',
                'logo' => 'LinkAja.png',
            ],
            [
                'name' => 'OVO / OneKlik',
                'type' => 'cash',
                'logo' => 'OneKlik.png',
            ],

            // Bank Transfers & Direct Debit
            [
                'name' => 'BCA KlikPay',
                'type' => 'transfer',
                'logo' => 'BCAKlikPay.png',
            ],
            [
                'name' => 'BRI Direct Debit',
                'type' => 'transfer',
                'logo' => 'BRIDirect Debit.png',
            ],
            [
                'name' => 'Mandiri E-Cash',
                'type' => 'transfer',
                'logo' => 'MandiriE-Cash.png',
            ],
            [
                'name' => 'Jenius Pay',
                'type' => 'transfer',
                'logo' => 'Jenius Pay.png',
            ],

            // QRIS & GPN
            [
                'name' => 'QRIS',
                'type' => 'cash',
                'logo' => 'QRIS.png',
            ],
            [
                'name' => 'GPN (Gerbang Pembayaran Nasional)',
                'type' => 'cash',
                'logo' => 'GPN.png',
            ],

            // Payment Gateway
            [
                'name' => 'DOKU',
                'type' => 'transfer',
                'logo' => 'DOKU.png',
            ],

            // Card Payment
            [
                'name' => 'Mastercard',
                'type' => 'cash',
                'logo' => 'Mastercard.png',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
