@extends ('layouts.app')

@section('content')
    <div class="container">
        @include ('shop.checkout.breadcrumbs')
        @render(App\ViewComponents\CheckoutFlowComponent::class)

        <div class="checkout__body">
            @render(App\ViewComponents\CheckoutCartComponent::class)
            <div class="checkout__main checkout__shipping">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-start-empty" role="tablist">
                    <li role="presentation">
                        <a
                          href="#in-store-pickup"
                          aria-controls="in-store-pickup"
                          role="tab"
                          data-toggle="tab"
                          class="btn btn-primary"
                        >
                            In-Store Pickup
                        </a>
                    </li>
                    <li role="presentation">
                        <a
                          href="#free-delivery"
                          aria-controls="free-delivery"
                          role="tab"
                          data-toggle="tab"
                          class="btn btn-primary"
                        >
                            Free Delivery
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="in-store-pickup">
                        <p>Lorem Ipsum</p>
                        <p>Pickup instructions</p>
                        <form method="POST" action="{{ route('shop.checkout.saveShipping') }}">
                            @csrf
                            <input type="hidden" name="in_store_pickup" value="1">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">
                                Continue to Payment
                            </button>
                        </form>
                        <input type="hidden" name="in-store-pickup" value="0">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="free-delivery">
                        <form class="shipping-form" method="POST" action="{{ route('shop.checkout.saveShipping') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="first-name">First Name *</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="first_name"
                                      id="first-name"
                                      value="{{ old('first_name') ?? $lUser->first_name }}"
                                    >
                                </div>
                                <div class="col-xs-6">
                                    <label for="last-name">Last Name *</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="last_name"
                                      id="last-name"
                                      value="{{ old('last_name') ?? $lUser->last_name}}"
                                    >
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
                                      value="{{ old('email') ?? $lUser->email }}"
                                    >
                                </div>
                                <div class="col-xs-6">
                                    <label for="phone">Phone Number *</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="phone"
                                      id="phone"
                                      value="{{ old('phone') ?? $lUser->phone }}"
                                    >
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
                                    <label for="city">City</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="city"
                                      id="city"
                                      value="{{ old('city') }}"
                                    >
                                </div>
                                <div class="col-xs-3">
                                    <label for="state">State</label>
                                    <input
                                       type="text"
                                      class="form-control"
                                      name="state"
                                      id="state"
                                      value="{{ old('state') }}"
                                    >
                                </div>
                                <div class="col-xs-3">
                                    <label for="zip">Zip</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="zip"
                                      id="zip"
                                      value="{{ old('zip') }}"
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>
                                        <input type="checkbox" name="save_address" value="1">
                                        Save this address
                                    </label>
                                </div>
                            </div>
                            <div class="row row-right">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary" name="submit" value="submit">
                                        Continue to Payment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
