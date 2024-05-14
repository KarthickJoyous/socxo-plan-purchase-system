@extends('layouts.users.app')

@section('content')
<div class="container">
    <button type="button" id="cancelPayment" class="btn btn-sm m-2" onclick="document.getElementById('cancelPaymentForm').submit();">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
        <form class="d-none" method="POST" id="cancelPaymentForm" action="{{route('user.checkout.cancel', $subscription_plan->unique_id)}}">
          @csrf
        </form>
    </button>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-text">{{$subscription_plan->name ?: __('messages.user.common.na')}}</h2>
                    <p class="card-text"><strong>{{__('messages.user.subscription_plans.price')}}:</strong> {{(new App\Helpers\viewHelper)->formatted_amount($subscription_plan->amount)}}</p>
                    <p class="card-text"><strong>{{__('messages.user.subscription_plans.description')}}:</strong> {{$subscription_plan->description ?: __('messages.user.common.na')}}</p>
                </div>
            </div>
            <p class="text-center p-3"></p>
        </div>
        <div class="col-md-8">
            <span>
                <h2>{{__('messages.user.subscription_plans.stripe_form_title')}}</h2>
            </span>
            <div class="card">
                <div class="card-body">
                    <form id="stripeForm" action="{{route('user.checkout', $subscription_plan->unique_id)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group pb-4">
                                    <label for="">{{__('messages.user.subscription_plans.email')}}:</label>
                                    <input type="text" disabled id="email" class="form-control" value="{{auth('web')->user()->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group pb-4">
                                    <label for="" class="mb-2">{{__('messages.user.subscription_plans.card_information')}}:</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group pb-4">
                                    <label for="">{{__('messages.user.subscription_plans.card_holder_name')}}:</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{auth('web')->user()->name}}" placeholder="Name on the card" required>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" id="cardBtn" data-secret="{{ $intent->client_secret }}">{{__('messages.user.subscription_plans.submit_btn')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{config('app.stripe.publicable_key')}}")

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const form = document.getElementById('stripeForm');
    const cardBtn = document.getElementById('cardBtn');
    const cardHolderName = document.getElementById('name');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        $("#cardBtn").attr('disabled', true);
        const {
            setupIntent,
            error
        } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        );

        if (error) {
            $("#cardBtn").attr('disabled', false);
            notify(error.message, 'danger');
        } else {
            handleBaseFormSubmit("card", "{{__('messages.user.subscription_plans.submit_btn_loading_text')}}");
            let token = document.createElement('input');
            token.setAttribute('type', 'hidden');
            token.setAttribute('name', 'paymentMethodId');
            token.setAttribute('value', setupIntent.payment_method);
            form.appendChild(token);
            form.submit();
        }
    });
</script>
@endsection
@endsection