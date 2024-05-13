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
	 * @param flaot $amount
	 * 
	 * @return string
	*/
	function formatted_amount($amount) {

		return setting('currency', '₹') . $amount;
	}
}