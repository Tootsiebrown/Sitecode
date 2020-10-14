@extends('core::emails.base')

@section('body')
    <table class="email__inner" width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">Sorry, someone else beat you to it.</h1>
                <p>We aren't able to  accept your offer on <a href="{{ $listing->url }}">{{ $listing->title }}</a>, because someone else bought our last one. We'll try to get more in soon!</p>

                <p><a href="{{ route('home') }}">Find something else!</a></p>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
