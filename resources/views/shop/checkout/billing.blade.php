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
        @render(App\ViewComponents\CheckoutFlowComponent::class)

        <div class="checkout__body">
            @render(App\ViewComponents\CheckoutCartComponent::class)
            <div class="checkout__main checkout__billing">
                <form method="POST" action="{{ route('shop.checkout.saveBilling') }}" data-component="stripe-form">
                    @csrf
                    @include('dashboard.flash_msg')
                    @include('site.components.field-error', ['field' => 'general'])
                    <div data-component="billing-same-as-shipping">
                        @if(! $shipment->in_store_pickup)
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>
                                        <input
                                          type="checkbox"
                                          name="same_as_shipping"
                                          value="1"
                                          data-element="toggle"
                                          @if (old('same_as_shipping')) checked @endif
                                        >
                                        Same as shipping
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div data-element="shipmentBillingInfo" class="hidden">
                            <p>
                                <span data-shipping-info="first-name">{{ $shipment->firstname }}</span>
                                <span data-shipping-info="last-name">{{ $shipment->lastname }}</span><br>
                                <span data-shipping-info="address1">{{ $shipment->address1 }}</span><br>
                                @if ($shipment->address2)
                                    <span data-shipping-info="address2">{{ $shipment->address2 }}</span><br>
                                @else
                                    <span data-shipping-info="address2"></span>
                                @endif
                                <span data-shipping-info="city">{{ $shipment->city }}</span>, <span data-shipping-info="state">{{ $shipment->state }}</span>
                            </p>
                        </div>

                        <div data-element="newBillingInfo">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="first-name">First Name *</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="first_name"
                                        id="first-name"
                                        value="{{ old('first_name') ?? $lUser->firstname ?? '' }}"
                                    >
                                    @include('site.components.field-error', ['field' => 'first_name'])
                                </div>
                                <div class="col-xs-6">
                                    <label for="last-name">Last Name *</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="last_name"
                                        id="last-name"
                                        value="{{ old('last_name') ?? $lUser->lastname ?? '' }}"
                                    >
                                    @include('site.components.field-error', ['field' => 'first_name'])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="email">Email *</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="email"
                                        id="email"
                                        value="{{ old('email')  ?? $lUser->email ?? '' }}"
                                    >
                                    @include('site.components.field-error', ['field' => 'first_name'])
                                </div>
                                <div class="col-xs-6">
                                    <label for="phone">Phone Number *</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="phone"
                                        id="phone"
                                        value="{{ old('phone') ?? $lUser->phone ?? '' }}"
                                    >
                                    @include('site.components.field-error', ['field' => 'phone'])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <label for="address1">Address Line 1 *</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="address1"
                                        id="address1"
                                        value="{{ old('address1') }}"
                                    >
                                    @include('site.components.field-error', ['field' => 'address1'])
                                </div>
                                <div class="col-xs-4">
                                    <label for="address2">Line 2</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="address2"
                                        id="address2"
                                        value="{{ old('address2') }}"
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="city">City *</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="city"
                                        id="city"
                                        value="{{ old('city') }}"
                                    >
                                    @include('site.components.field-error', ['field' => 'city'])
                                </div>
                                <div class="col-xs-6">
                                    <label for="state">State *</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="state"
                                        id="state"
                                        value="{{ old('state') }}"
                                    >
                                    @include('site.components.field-error', ['field' => 'state'])
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <label>Credit Card *</label>
                            <br>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <br>@include('site.components.field-error', ['field' => 'payment'])

                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="" data-element="tokenField">
                    <input type="hidden" name="last_four" value="" data-element="lastFourField">
                    <input type="hidden" name="zip" value="" data-element="zipField">
                    <input type="hidden" name="brand" value="" data-element="brandField">

                    <div class="row">
                        <div class="col-xs-6">
                            <label for="terms_and_conditions">Terms and Conditions</label><br/>
                            <label>
                                <input
                                    type="checkbox"
                                    name="terms_and_conditions"
                                    value="1"
                                    @if (old('terms_and_conditions')) checked @endif
                                > Accept
                            </label>
                            &nbsp;&nbsp(<a href="/terms-and-conditions" target="_blank">Review</a>)
                            @include('site.components.field-error', ['field' => 'terms_and_conditions'])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <label>&nbsp;<!-- spacing --></label><br/>
                            <button class="btn btn-primary" type="submit" name="do it" value="1" data-element="submitButton">
                                Pay
                            </button>
                            <img alt="loading..." src="/assets/img/loading-spinner.gif" class="billing-loading-spinner hidden" data-element="spinner">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

