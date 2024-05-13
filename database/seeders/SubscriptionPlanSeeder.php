<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionPlan::updateOrCreate(['api_id' => 'price_1PFmwOSAFxTMvWwPvIoMr5xX'] + [
            'name' => 'Basic Plan',
            'amount' => 10,
            'description' => 'Suitable for basic needs.'
        ]);

        SubscriptionPlan::updateOrCreate(['api_id' => 'price_1PFmwwSAFxTMvWwPSmyfQuHA'] + [
            'name' => 'Standard Plan',
            'amount' => 20,
            'description' => 'Suitable for standard needs.'
        ]);

        SubscriptionPlan::updateOrCreate(['api_id' => 'price_1PFmxESAFxTMvWwPmGCl38bW'] + [
            'name' => 'Premium Plan',
            'amount' => 30,
            'description' => 'Suitable for premium needs.'
        ]);
    }
}
