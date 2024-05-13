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
            'password' => '4c2[F21)'
        ]);

        User::updateOrCreate(['email' => "test@demo.com"], [
            'name' => 'Test',
            'email_verified_at' => now(),
            'password' => 'X4t5(&1('
        ]);
    }
}
