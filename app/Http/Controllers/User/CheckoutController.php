<?php

namespace App\Http\Controllers\User;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse};
use App\Http\Requests\User\CheckoutRequest;
use App\Models\{SubscriptionPlan, SubscriptionPlanPayment};

class CheckoutController extends Controller
{
    /** 
     * To show the checkout page.
     * @param string $subscription_plan
     * @return RedirectResponse
    */
    public function checkoutForm($subscription_plan) {
        
        abort_if(!$subscription_plan = SubscriptionPlan::firstWhere(['unique_id' => $subscription_plan]), 404);

        return view('users.subscription_plans.checkout', [
            'subscription_plan' => $subscription_plan
        ]);
    }

    /** 
     * To redirct to stripe checkout.
     * @param CheckoutRequest $request
     * @param string $subscription_plan
     * @return RedirectResponse
    */
    public function initiate_checkout(CheckoutRequest $request, $subscription_plan) {

        abort_if(!$subscription_plan = SubscriptionPlan::firstWhere(['unique_id' => $subscription_plan]), 404);

        try {

            $user = $request->user();

            $user->update($request->validated());

            $subscription_plan_payment = DB::transaction(function() use($user, $subscription_plan) {

                $subscription_plan_payment = SubscriptionPlanPayment::Create([
                    'subscription_plan_id' => $subscription_plan->id,
                    'user_id' => $user->id,
                    'amount' => $subscription_plan->amount,
                    'payment_id' => '',
                    'status' => CHECKOUT_INITIATED
                ]);

                throw_if(!$subscription_plan_payment, new Exception(__('messages.user.subscription_plans.create_subscription_failed')));

                return $subscription_plan_payment;
            });

            return $user->newSubscription('default', $subscription_plan->api_id)->checkout([ 
                'success_url' => route('user.payment.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('user.payment.cancel')."?subscription_plan_payment_id=$subscription_plan_payment->id",
                'metadata' => [
                    'subscription_plan_payment_id' => $subscription_plan_payment->id
                ] 
            ]);

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    /** 
     * To show the stripe payment paypage.
     * @param Request $request
     * @param string $subscription_plan
     * @return RedirectResponse
    */
    public function stripeForm(Request $request, $subscription_plan) {
        
        abort_if(!$subscription_plan = SubscriptionPlan::firstWhere(['unique_id' => $subscription_plan]), 404);

        try {

            return view('users.subscription_plans.stripe', [
                'subscription_plan' => $subscription_plan,
                'intent' => $request->user()->createSetupIntent()
            ]);

        } catch(Exception $e) {

            return redirect()->route('user.checkoutForm', $subscription_plan->unique_id)->with('error', $e->getMessage());
        }
    }

    /** 
     * To make the stripe payment & save transaction for user.
     * @param Request $request
     * @param string $subscription_plan
     * @return RedirectResponse
    */
    public function checkout(Request $request, $subscription_plan) {

        abort_if(!$subscription_plan = SubscriptionPlan::firstWhere(['unique_id' => $subscription_plan]), 404);

        try {

            throw_if(!$request->paymentMethodId, new Exception(__('messages.user.subscription_plans.checkout_no_payment_method_error')));

            $user = $request->user();

            $subscription = $user->newSubscription('default', $subscription_plan->api_id)->create($request->paymentMethodId);

            throw_if(!$subscription, new Exception(__('messages.user.subscription_plans.create_subscription_failed')));

            $subscription_plan_payment = DB::transaction(function() use($user, $subscription_plan, $subscription) {

                $max_expire_date = SubscriptionPlanPayment::query()
                ->where(['user_id' => $user->id])
                ->whereDate('expire_at', '>=', now())
                ->latest('expire_at')
                ->first()?->expire_at;

                $stripe_status = $subscription->stripe_status == 'active' ? CHECKOUT_SUCCESS : CHECKOUT_FAILED;

                $subscription_plan_payment = SubscriptionPlanPayment::Create([
                    'subscription_plan_id' => $subscription_plan->id,
                    'user_id' => $user->id,
                    'amount' => $subscription_plan->amount,
                    'payment_id' => $stripe_status ? ($subscription->stripe_id ?? Str::uuid()) : '',
                    'expire_at' => $stripe_status ? ($max_expire_date ? Carbon::parse($max_expire_date)->addMonths(1) : now()->addMonths(1)) : NULL,
                    'status' => $stripe_status
                ]);

                throw_if(!$subscription_plan_payment, new Exception(__('messages.user.subscription_plans.create_subscription_failed')));

                return $subscription_plan_payment;
            });

            return redirect()->route('user.transactions.show', $subscription_plan_payment->unique_id);

        } catch(Exception $e) {

            return redirect()->route('user.checkoutForm', $subscription_plan->unique_id)->with('error', $e->getMessage());
        }
    }

    /** 
     * To cancel a checkout.
     * @param string $subscription_plan
     * @return RedirectResponse
    */
    public function checkoutCancel($subscription_plan) {

        abort_if(!$subscription_plan = SubscriptionPlan::firstWhere(['unique_id' => $subscription_plan]), 404);

        try {

            $subscription_plan_payment = DB::transaction(function() use($subscription_plan) {

                $subscription_plan_payment = SubscriptionPlanPayment::Create([
                    'subscription_plan_id' => $subscription_plan->id,
                    'user_id' => auth('web')->id(),
                    'payment_id' => '',
                    'amount' => $subscription_plan->amount,
                    'status' => CHECKOUT_CANCELLED
                ]);

                throw_if(!$subscription_plan_payment, new Exception(__('messages.user.subscription_plans.cancel_subscription_failed')));

                return $subscription_plan_payment;
            });

            return redirect()->route('user.transactions.show', $subscription_plan_payment->unique_id);

        } catch(Exception $e) {

            return redirect()->route('user.checkoutForm', $subscription_plan->unique_id)->with('error', $e->getMessage());
        }
    }
}
