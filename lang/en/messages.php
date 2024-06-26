<?php

return [

	"user" => [

		"register" => [
			"title" => "Register",
			"note" => "Create an Account",
			"sub_note" => "Enter your personal details to create account",
			"name" => "Name",
			"name_placeholder" => "Enter name",
			"name_invalid_feedback" => "Please enter your name!",
			"email" => "Email",
			"email_placeholder" => "Enter email",
			"email_invalid_feedback" => "Please enter your email!",
			"password" => "Password",
			"password_placeholder" => "Enter password",
			"password_invalid_feedback" => "Please enter your password!",
			"confirm_password" => "Confirm Password",
			"confirm_password_placeholder" => "Enter confirm password",
			"confirm_password_invalid_feedback" => "Please enter your confirm password!",
			"submit_btn" => "Create Account",
			"submit_btn_loading_text" => "Creating Account...",
			"login_note" => "Already have an account?",
			"login_btn" => "Login",
			"register_failed" => "Create account failed. Please try again.",
			"register_success" => "Registration Success"
		],

		"login" => [
			"title" => "Login",
			"note" => "Login to Your Account",
			"sub_note" => "Enter your email & password to login",
			"email" => "Email",
			"email_placeholder" => "Enter email",
			"email_invalid_feedback" => "Please enter your email!",
			"password" => "Password",
			"password_placeholder" => "Enter password",
			"password_invalid_feedback" => "Please enter your password!",
			"remember_me" => "Remember me",
			"submit_btn" => "Login",
			"submit_btn_loading_text" => "Logging In...",
			"register_note" => "Don't have account?",
			"register_btn" => "Create an account",
			"invalid_credentials" => "Invalid Email / Password.",
			"login_success" => "Login Success.",
			"password_space_validation_message" => "Space are not allowed in passwords.",
			"forgot_password" => "Forgot Password ?"
		],

		"logout" => [
			"title" => "Signout",
			"logout_confirmation" => "Are you sure you want to signout from the current session?",
			"submit_btn_loading_text" => "Signing Out...",
			"logout_success" => "Signout Success.",
			"cancel" => "Cancel"
		],

		"header" => [
			"profile" => "Profile",
			"logout" => "Logout",
		],

		"sidebar" => [
			"home" => "Home",
			"profile" => "Profile",
			"logout" => "Logout",
		],

		"home" => [
			"title" => "Home"
		],

		"profile" => [
			"title" => "Profile",
			"name" => "Name",
			"mobile" => "Mobile",
			"email" => "Email",
			"user_profile" => "User Profile",
			"address" => "Address",
			"city" => "City",
			"country" => "Country",
			"postal_code" => "Postal Code",
			"not_found" => "Profile not found (:email)"
		],

		"common" => [
			"na" => "N/A",
			"enabled" => "Enabled",
			"disabled" => "Disabled",
			"failed" => "Failed",
			"success" => "Success",
			"cancelled" => "Cancelled",
			"no_data_found" => "No Data Found.",
			"initiated" => "Initiated"
		],

		"errors" => [
			"too_many_attempts" => "Too many attempts. Please wait for a minute and try again."
		],

		"subscription_plans" => [
			'title' => 'Subscription Plans',
			"available_plans" => "Available Plans",
			'amount' => 'Amount',
			'price' => 'Price',
			"description" => "Description",
			'checkout' => "Checkout",
			"subscribe" => "Subscribe",
			"checkout_success" => "Payment success.",
			"checkout_failed" => "Payment failed.",
			"name" => "Name",
			"mobile" => "Mobile",
			"email" => "Email",
			"address" => "Address",
			"city" => "City",
			"country" => "Country",
			"postal_code" => "Postal Code",
			"card_holder_name" => "Cardholder name",
			"submit" => "Submit Payment",
			"webhook_event_error" => "Stripe webhook event received (:event)",
			"not_found" => "Subscription plan not found (:api_id)",
			"model_not_found" => "Subscription plan not found",
			"checkout_no_payment_method_error" => "Transaction failed. Please try again.",
			"create_subscription_failed" => "Subscription creation failed. Please try again.",
			"cancel_subscription_failed" => "Subscription cancellation failed. Please try again.",
			"card_information" => "Card Information",
			"submit_btn_loading_text" => "Processing Payment...",
			"submit_btn" => "Pay",
			"stripe_form_title" => "Pay with card",
			"status_updation_error" => "Payment has been already marked as :status",
			"session_not_found" => "No payment found."
		],

		"transactions" => [
			"title" => "Transactions",
			"price" => "Price",
			"amount" => "Amount",
			"payment_reference" => "Payment Reference",
			"status" => "Payment Status",
			"transaction_date" => "Transaction Date",
			"expire_at" => "Expire At",
			"plan_name" => "Plan Name",
			"action" => "Action",
			"view" => "View",
			"details" => "Transaction Details",
			"s_no" => "S.No",
			"status_success_message" => "Payment Successful",
			"status_cancelled_message" => "Payment Cancelled",
			"status_failed_message" => "Payment Failed",
			"status_success_note" => "Thank you for your payment!",
		]
	]
];