<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPlanPayment;

class SubscriptionPlanPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $user_id = 1;

        foreach(range(0, 20) as $key) {

            $subscription_plan = SubscriptionPlan::firstWhere(['id' => rand(1, 3)]);

            if($subscription_plan) {

                $status = rand(CHECKOUT_FAILED, CHECKOUT_SUCCESS);

                SubscriptionPlanPayment::Create([
                    'user_id' => $user_id,
                    'subscription_plan_id' => $subscription_plan->id,
                    'amount' => $subscription_plan->amount,
                    'payment_id' => $status == CHECKOUT_SUCCESS ? Str::uuid() : '',
                    'expire_at' => $status == CHECKOUT_SUCCESS ? now()->addMonth(1) : NULL,
                    'status' => $status
                ]);
            }
        }
    }
}
