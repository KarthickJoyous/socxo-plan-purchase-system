<?php

namespace App\Http\Controllers;

use App\Helpers\viewHelper;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPlanPayment;

class PaymentStatusController extends Controller
{   
    /**
     * To find & validate the payment status.
     * @param int $paymentId
     * @return obj SubscriptionPlanPayment
    */
    private function findPayment($paymentId) {

        $subscription_plan_payment = SubscriptionPlanPayment::find($paymentId);

        throw_if(!$subscription_plan_payment, new Exception(__('messages.user.subscription_plans.model_not_found')));

        throw_if(!in_array($subscription_plan_payment->status, [CHECKOUT_INITIATED, CHECKOUT_CANCELLED]), new Exception(
            __('messages.user.subscription_plans.status_updation_error', ['status' => (new viewHelper)->payment_status_formatted($subscription_plan_payment->status)])
        ));

        return $subscription_plan_payment;
    }

    /**
     * To process the stripe checkout redirection & update the payment status.
     * @param Request $request
     * @return View|String
    */
    public function success(Request $request)
    {
        try {

            throw_if(!$session_id = $request->get('session_id'), new Exception(__('messages.user.subscription_plans.session_not_found')));

            $session = Cashier::stripe()->checkout->sessions->retrieve($session_id);

            $subscription_plan_payment = $this->findPayment($session['metadata']['subscription_plan_payment_id'] ?? null);

            $subscription_plan_payment = DB::transaction(function() use($subscription_plan_payment, $session) {

                $status = $session->payment_status == 'paid' ? CHECKOUT_SUCCESS : CHECKOUT_FAILED;

                $max_expire_date = SubscriptionPlanPayment::query()
                ->where(['user_id' => $subscription_plan_payment->user_id])
                ->whereDate('expire_at', '>=', now())
                ->latest('expire_at')
                ->first()?->expire_at;

                $subscription_plan_payment->update([
                    'status' => $status,
                    'payment_id' => $status == CHECKOUT_SUCCESS ? ($session->subscription ?? Str::uuid()) : '',
                    'expire_at' => $status == CHECKOUT_SUCCESS ? ($max_expire_date ? Carbon::parse($max_expire_date)->addMonths(1) : now()->addMonths(1)) : NULL
                ]);

                return $subscription_plan_payment;
            });

            return view('users.subscription_plan_payments.show', [
                'transaction' => $subscription_plan_payment
            ]);

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * To make a payment as cancelled.
     * @param Request $request
     * @return View|String
    */
    public function cancel(Request $request)
    {
        try {

            $subscription_plan_payment = $this->findPayment($request->subscription_plan_payment_id);

            $subscription_plan_payment->update([
                'status' => CHECKOUT_CANCELLED
            ]);

            return view('users.subscription_plan_payments.show', [
                'transaction' => $subscription_plan_payment
            ]);

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}
