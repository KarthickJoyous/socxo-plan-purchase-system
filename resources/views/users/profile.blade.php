@extends('layouts.users.app')

@section('content')
<div class="card">
    <h5 class="card-header">{{__('messages.user.profile.user_profile')}}</h5>
    <div class="card-body">
        <h2 class="card-title">{{$user->name ?: __('messages.user.common.na')}}</h2>
        <p class="card-text"><strong>{{__('messages.user.profile.email')}}:</strong> {{$user->email ?: __('messages.user.common.na')}}</p>
        <p class="card-text"><strong>{{__('messages.user.profile.address')}}:</strong> {{$user->address ?: __('messages.user.common.na')}}</p>
        <p class="card-text"><strong>{{__('messages.user.profile.city')}}:</strong> {{$user->city ?: __('messages.user.common.na')}}</p>
        <p class="card-text"><strong>{{__('messages.user.profile.country')}}:</strong> {{$user->country ?: __('messages.user.common.na')}}</p>
        <p class="card-text"><strong>{{__('messages.user.profile.postal_code')}}:</strong> {{$user->postal_code ?: __('messages.user.common.na')}}</p>
    </div>
</div>
@endsection