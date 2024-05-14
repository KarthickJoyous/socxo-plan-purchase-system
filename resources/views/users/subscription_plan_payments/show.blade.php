@extends('layouts.users.app')

@section('title', __('messages.user.transactions.title'))

@section('content')
<div class="card">
  <div class="card-body">
    <h1 class="card-title">
        {{
            (new App\Helpers\viewHelper)->payment_status_message_formatted($transaction->status)
        }}
    </h1>
    @if($transaction->status == CHECKOUT_SUCCESS)
        <p class="card-text">{{__('messages.user.transactions.status_success_note')}}</p>
        <p class="card-text">{{__('messages.user.transactions.payment_reference')}} :  {{$transaction->payment_id ?: __('messages.user.common.na')}}</p>
        <p class="card-text">{{__('messages.user.transactions.amount')}} :  {{(new App\Helpers\viewHelper)->formatted_amount($transaction->amount)}}</p>
    @endif
  </div>
</div>
@endsection