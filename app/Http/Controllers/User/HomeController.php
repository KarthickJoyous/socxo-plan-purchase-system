<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('users.home', [
            'subscription_plans' => SubscriptionPlan::approved()->get(['unique_id', 'name', 'amount', 'description'])
        ]);
    }
}
