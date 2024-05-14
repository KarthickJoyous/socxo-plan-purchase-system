<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\HomeController;

use App\Http\Controllers\User\Auth\{RegisterController, LoginController};
use App\Http\Controllers\User\Account\{UserProfileController, LogoutController};
use App\Http\Controllers\User\{CheckoutController, SubscriptionPlanPaymentController};
use App\Http\Controllers\PaymentStatusController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['as' => 'user.'], function() {

	Route::group(['middleware' => ['guest:web', 'throttle:50'] ], function() {

		Route::get('', function() { return view('users.auth'); })->name('auth');

		Route::post('register', RegisterController::class)->name('register');

		Route::post('login', LoginController::class)->name('login');
	});

	Route::group(['middleware' => ['auth:web']], function() {

		Route::get('home', HomeController::class)->name('home');

		Route::get('profile', UserProfileController::class)->name('profile');

		Route::get('checkout/{subscription_plan}', [CheckoutController::class, 'checkoutForm'])->name('checkoutForm');

		Route::post('initiate_checkout/{subscription_plan}', [CheckoutController::class, 'initiate_checkout'])->name('initiate_checkout');

		// Route::get('payment/{subscription_plan}', [CheckoutController::class, 'stripeForm'])->name('stripeForm');

		// Route::post('checkout/{subscription_plan}', [CheckoutController::class, 'checkout'])->name('checkout');

		// Route::post('checkout/cancel/{subscription_plan}', [CheckoutController::class, 'checkoutCancel'])->name('checkout.cancel');

		Route::resource('transactions', SubscriptionPlanPaymentController::class)->only(['index', 'show'])->scoped([
			'transaction' => 'unique_id'
		]);

		Route::get('logout', LogoutController::class)->name('logout');
	});

	Route::get('payment-success', [PaymentStatusController::class, 'success'])->name('payment.success');

	Route::get('payment-cancel', [PaymentStatusController::class, 'cancel'])->name('payment.cancel');
});