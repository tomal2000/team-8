<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::create([
            'name' => 'Hand Cash',
            'branch' => 'Default',
            'account_no' => '9999',
            'is_active' => true,
        ]);
        Bank::create([
            'name' => 'Gateways',
            'branch' => 'Default',
            'account_no' => '0000',
            'is_active' => true,
        ]);
    }
}
