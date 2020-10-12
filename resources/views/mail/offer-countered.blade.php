@extends('core::emails.base')

@section('body')
    <table class="email__inner" width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">Offer Countered!</h1>
                <p>We can&rsquo;t quite accept your offer on <a href="{{ $listing->url }}">{{ $listing->title }}</a>, but what about this?</p>
                <table>
                    <tr style="background-color: #E9ECEF;">
                        <td class="email-cart__heading" style="padding: 16px;">Quantity</td>
                        <td class="email-cart__heading" style="padding: 16px;">Price</td>
                    </tr>
                    <tr style="background-color: #F8F9FA;">
                        <td class="" style="padding:16px;">
                            {{ $offer->counter_quantity }}
                        </td>
                        <td style="padding:16px;">${{ $offer->counter_price }}</td>
                    </tr>
                </table>

                <p><a href="{{ route('dashboard.my-offers.show', ['id' => $offer->id]) }}">Review Counter</a></p>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
