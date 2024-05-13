<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\HomeController;

use App\Http\Controllers\User\Auth\{RegisterController, LoginController};
use App\Http\Controllers\User\Account\{UserProfileController, LogoutController};
use App\Http\Controllers\User\{CheckoutController, SubscriptionPlanPaymentController};
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

		Route::post('checkout/{subscription_plan}', [CheckoutController::class, 'checkout'])->name('checkout');

		Route::resource('transactions', SubscriptionPlanPaymentController::class)->only(['index']);

		Route::get('logout', LogoutController::class)->name('logout');
	});

	Route::get('payment-success', function() {
		return view('users.subscription_plans.success');
	})->name('payment_success');

	Route::get('payment-cancelled', function() {
		return view('users.subscription_plans.cancelled');
	})->name('payment_cancelled');
});