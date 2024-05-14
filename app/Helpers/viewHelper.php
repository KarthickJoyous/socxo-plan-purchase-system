<?php

namespace App\Helpers;

use Carbon\Carbon;

class viewHelper {

	/**
	 * To convert UTC timestamp to user_timezone timestamp with desired format.
	 * 
	 * @param string $timestamp
	 * @param string $timezone
	 * @param string $format
	 * 
	 * @return string
	*/
	function convert_timezone($timestamp, $timezone, $format = 'd/m/Y H:i A'): string {
		
		return $timestamp ? Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC')->setTimezone($timezone)->format($format) : __('messages.user.common.na');
	}
	
	/**
	 * To format amount with currency.
	 * 
	 * @param float $amount
	 * 
	 * @return string
	*/
	function formatted_amount($amount) {

		return setting('currency', '₹') . ' ' .  number_format($amount, 2);
	}

	/**
	 * To format payment status.
	 * 
	 * @param int $status
	 * 
	 * @return string
	*/
	function payment_status_formatted($status) {

		$payment_statuses = [
			CHECKOUT_FAILED => __('messages.user.common.failed'),
			CHECKOUT_CANCELLED => __('messages.user.common.cancelled'),
			CHECKOUT_SUCCESS => __('messages.user.common.success'),
		];

		return $payment_statuses[$status] ?? __('messages.user.common.na');
	}

	/**
	 * To format payment status.
	 * 
	 * @param int $status
	 * 
	 * @return string
	*/
	function payment_status_badge_formatted($status) {

		$payment_badges = [
			CHECKOUT_FAILED => 'danger',
			CHECKOUT_CANCELLED => 'warning',
			CHECKOUT_SUCCESS => 'success',
		];

		return $payment_badges[$status] ?? 'dark';
	}

	/**
	 * To format payment status.
	 * 
	 * @param int $status
	 * 
	 * @return string
	*/
	function payment_status_message_formatted($status) {

		$payment_messages = [
			CHECKOUT_FAILED => __('messages.user.transactions.status_failed_message'),
			CHECKOUT_CANCELLED => __('messages.user.transactions.status_cancelled_message'),
			CHECKOUT_SUCCESS => __('messages.user.transactions.status_success_message')
		];

		return $payment_messages[$status] ?? __('messages.user.common.na');
	}
}