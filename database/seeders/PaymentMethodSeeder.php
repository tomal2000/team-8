<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Mobile Banking',
                'slug' => 'mobile_banking',
                'instant' => true,
            ],
            [
                'name' => 'Bank Transfer',
                'slug' => 'bank_transfer',
                'instant' => false,
                'inputs' => [
                    'label' => 'Transaction Id',
                    'name' => 'transaction_id',
                    'id' => 'transaction_id',
                    'required' => true
                ],
            ],
            ['name' => 'Hand Cash','slug' => 'hand_cash','instant' => false,]
        ];
    }
}
