<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $user = User::create([
                'first_name' => 'Tomal',
                'last_name' => 'Sen',
                'mobile' => '01307366733',
                'email' => 'tomalsen2000@gmail.com',
                'password' => Hash::make('123456789'),
                'is_payment_collector' => true,
            ]);
            $user->addRole('admin');
    }
}
