@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('shop.checkout.breadcrumbs')
        @render(App\ViewComponents\CheckoutFlowComponent::class)

        <div class="checkout__body">
            @render(App\ViewComponents\CheckoutCartComponent::class)
            <div class="checkout__main checkout__rates">
                <form method="POST" action="{{ route('shop.checkout.saveRate') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xs-6">
                            <select name="rate_id" class="select2">
                                @foreach ($rates as $rate)
                                    <option
                                      value="{{ $rate->id }}"
                                      @if ($rate->service_name === $defaultRate) selected @endif
                                    >
                                        {{ $rate->service_name }} (${{ $rate->amount }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="btn btn-primary" type="submit" name="action" value="Save Rate">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
