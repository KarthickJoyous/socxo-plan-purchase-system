@extends('layouts.users.app')

@section('title', __('messages.user.subscription_plans.checkout'))

@section('breadcrumn') @endsection

@section('content')
<h2>{{__('messages.user.subscription_plans.checkout')}}</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-text">{{$subscription_plan->name ?: __('messages.user.common.na')}}</h2>
                <p class="card-text"><strong>{{__('messages.user.subscription_plans.price')}}:</strong> {{(new App\Helpers\viewHelper)->formatted_amount($subscription_plan->amount)}}</p>
                <p class="card-text"><strong>{{__('messages.user.subscription_plans.description')}}:</strong> {{$subscription_plan->description ?: __('messages.user.common.na')}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('user.checkout', $subscription_plan->unique_id)}}">
                    @csrf
                    <div class="form-group p-2">
                        <label for="name">{{__('messages.user.subscription_plans.name')}}</label>
                        <input type="text" class="form-control" id="name" value="{{auth('web')->user()->name}}" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="email">{{__('messages.user.subscription_plans.email')}}</label>
                        <input type="email" class="form-control" value="{{auth('web')->user()->email}}" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="address">{{__('messages.user.subscription_plans.address')}}</label>
                        <textarea class="form-control" id="address" rows="3" placeholder="Enter your address" required>{{auth('web')->user()->address}}</textarea>
                    </div>
                    <div class="form-group p-2">
                        <label for="city">{{__('messages.user.subscription_plans.city')}}</label>
                        <input type="text" class="form-control" id="city" value="{{auth('web')->user()->city}}" placeholder="Enter your city" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="country">{{__('messages.user.subscription_plans.country')}}</label>
                        <input type="text" class="form-control" id="country" value="{{auth('web')->user()->country}}" placeholder="Enter your country" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="postal_code">{{__('messages.user.subscription_plans.postal_code')}}</label>
                        <input type="text" class="form-control" id="postal_code" value="{{auth('web')->user()->postal_code}}" placeholder="Enter your postal code" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 p-2">{{__('messages.user.subscription_plans.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection