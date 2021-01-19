@extends('core::emails.base')

@section('body')
    <table class="email__inner" style=""
           width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">You've won!</h1>
                <h2 class="email__subhead">
                    <a href="{{ route('singleListing', ['id' => $listing->id, 'slug' => $listing->slug]) }}">
                        {{ $listing->title }}
                    </a>
                </h2>
                <p>Please pay promptly to finalize the deal.</p>
                <table width="100%" cellspacing="0">
                    <tr>
                        <td align="center">
                            <h2 class="email__subhead">
                                <a href="{{ route('payForEndedAuction', ['id' => $listing->id]) }}" class="email__cta">
                                    Pay Now
                                </a>
                            </h2>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
