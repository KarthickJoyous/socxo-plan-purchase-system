<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => "demo@demo.com"], [
            'name' => 'Demo',
            'email_verified_at' => now(),
            'password' => Hash::make('4c2[F21)'),
            'address' => "Bangaluru, KA",
            'city' => 'Bengaluru',
            'country' => 'India',
            'postal_code' => '560121'
        ]);

        User::updateOrCreate(['email' => "test@demo.com"], [
            'name' => 'Test',
            'email_verified_at' => now(),
            'password' => Hash::make('X4t5(&1('),
            'address' => "Bangaluru, KA",
            'city' => 'Bengaluru',
            'country' => 'India',
            'postal_code' => '560121'
        ]);
    }
}
