@extends('layouts.users.app')

@section('title', __('messages.user.transactions.title'))

@section('content')
<h2 class="">{{__('messages.user.transactions.title')}} ({{$transactions->total()}})</h2>
<table class="table">
    <thead class="table-light" style="height: 15px;">
        <tr>
            <th scope="col">{{__('messages.user.transactions.s_no')}}</th>
            <th scope="col">{{__('messages.user.transactions.transaction_date')}}</th>
            <th scope="col">{{__('messages.user.transactions.payment_reference')}}</th>
            <th scope="col">{{__('messages.user.transactions.plan_name')}}</th>
            <th scope="col">{{__('messages.user.transactions.price')}}</th>
            <th scope="col">{{__('messages.user.transactions.status')}}</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
    @forelse ($transactions as $key => $transaction)
        <tr>
            <th scope="row">{{$transactions->firstItem() + $key}}</th>
            <td>{{(new App\Helpers\viewHelper)->convert_timezone($transaction->created_at, DEFAULT_TIMEZONE, 'd-M-Y H:i:s')}}</td>
            <td>{{$transaction->payment_id ?: __('messages.user.common.na')}}</td>
            <td>{{$transaction->subscriptionPlan->name ?: __('messages.user.common.na')}}</td>
            <td>{{(new App\Helpers\viewHelper)->formatted_amount($transaction->amount)}}</td>
            <td>
                <span class="badge rounded-pill bg-{{$transaction->status ? 'success' : 'danger'}}">
                    {{$transaction->status ? __('messages.user.common.success') : __('messages.user.common.failed') }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">{{__('messages.user.common.no_data_found')}}</td>
        </tr>
        @endforelse
    </tbody>
</table>
@if($transactions->hasPages())
<div class="d-flex justify-content-end">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                {{$transactions->links('pagination::bootstrap-4')}}
            </li>
        </ul>
    </nav>
</div>
@endif
@endsection