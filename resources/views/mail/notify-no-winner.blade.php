@extends('core::emails.base')

@section('body')
    <table class="email__inner" width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">Auction ended with no winner...</h1>
                <h2 class="email__subhead">
                    <a href="{{ route('dashboard.listings.showEdit', ['id' => $listing->id]) }}">
                        {{ $listing->title }}
                    </a>
                </h2>
                <p>Feel free to set a new bid deadline or take other action.</p>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
