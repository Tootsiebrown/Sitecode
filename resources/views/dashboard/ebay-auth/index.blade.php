@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Ebay Status</h1>

    <p>{{ $linkStatus }}</p>

    @if ($linkStatus == 'Not Linked')
        <a href="{{ route('dashboard.ebayAuth.initiateLink') }}">Link accounts</a>
    @endif

    <p>{{ $tokenStatus }}</p>

    <p>{{ $refreshTokenStatus }}</p>

    @if ($refreshTokenStatus == 'Expired')
        <a href="{{ route('dashboard.ebayAuth.initiateLink') }}">Re-link accounts</a>
    @endif

@endsection
