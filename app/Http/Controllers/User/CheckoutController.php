<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{SubscriptionPlan};
use Illuminate\Http\{RedirectResponse};

class CheckoutController extends Controller
{
    /** 
     * To show the checkout page.
     * @return RedirectResponse
    */
    public function checkoutForm($subscription_plan) {
        
        abort_if(!$subscription_plan = SubscriptionPlan::firstWhere(['unique_id' => $subscription_plan]), 404);

        return view('users.subscription_plans.checkout', [
            'subscription_plan' => $subscription_plan
        ]);
    }

    /** 
     * To make the stripe payment & save transaction for user.
     * @return RedirectResponse
    */
    public function checkout($subscription_plan) {

        abort_if(!$subscription_plan = SubscriptionPlan::firstWhere(['unique_id' => $subscription_plan]), 404);

        return view('users.subscription_plans.checkout', [
            'subscription_plan' => $subscription_plan
        ]);
    }
}
