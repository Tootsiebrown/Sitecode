@extends ('layouts.app')

@section('page-js')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        // Set your publishable key: remember to change this to your live publishable key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        var stripe = Stripe('{{ $stripePublishableKey }}');
    </script>
@endsection

@section('content')
    <div class="container">
        @include ('shop.checkout.breadcrumbs')
        @include ('shop.checkout.flow-header', ['step' => 1])

        <div class="checkout__body">
            @render(App\ViewComponents\CheckoutCartComponent::class)
            <div class="checkout__main checkout__billing">
                <form method="POST" action="{{ route('shop.checkout.saveBilling') }}" data-component="stripe-form">
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert"></div>
                    <input type="hidden" name="token" value="" data-element="tokenField"/>
                </form>
            </div>
        </div>
    </div>
@endsection

