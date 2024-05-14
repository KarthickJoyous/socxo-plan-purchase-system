@extends('layouts.users.app')

@section('title', __('messages.user.home.title'))

@section('content')
<h2>{{__('messages.user.subscription_plans.available_plans')}}:</h2>
<div class="row">
    @foreach ($subscription_plans as $subscription_plan)
        <div class="col-md-4 pb-3">
            <div class="card">
                <div class="card-header">
                    {{$subscription_plan->name}}
                </div>
                <div class="card-body m-4">
                    <h5 class="card-title">{{__('messages.user.subscription_plans.price')}} : {{(new App\Helpers\viewHelper)->formatted_amount($subscription_plan->amount)}}</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{$subscription_plan->description}}</li>
                    </ul>
                    <a target="__blank" href="{{route('user.checkoutForm', $subscription_plan->unique_id)}}" class="btn btn-primary mt-3">
                        {{__('messages.user.subscription_plans.subscribe')}}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection