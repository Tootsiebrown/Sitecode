@extends('core::emails.base')

@section('body')
    <table class="email__inner" width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">Offer Accepted!</h1>
                <p>We‘ve accepted your offer on <a href="{{ $listing->url }}">{{ $listing->title }}</a>.</p>
                <table>
                    <tr style="background-color: #E9ECEF;">
                        <td class="email-cart__heading" style="padding: 16px;">Quantity</td>
                        <td class="email-cart__heading" style="padding: 16px;">Price</td>
                    </tr>
                    <tr style="background-color: #F8F9FA;">
                        <td class="" style="padding:16px;">
                            {{ $quantity }}
                        </td>
                        <td style="padding:16px;">{{ Currency::format($price) }}</td>
                    </tr>
                </table>

                <p>Your offer expires in 24 hours. Please <a href="{{ route('payForAcceptedOffer', ['id' => $offer->id]) }}">pay</a> promptly!</p>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
