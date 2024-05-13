<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate([
            'key' => 'app_name', 
            'value' => 'Plan Purchase System'
        ]);

        Setting::updateOrCreate([
            'key' => 'app_logo', 
            'value' => asset('assets/img/logo.png')
        ]);

        Setting::updateOrCreate([
            'key' => 'currency', 
            'value' => '₹'
        ]);
    }
}
