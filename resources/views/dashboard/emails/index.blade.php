@extends('layouts.dashboard', ['title' => 'Preview Emails']);

@section('dashboard-content')
    <ul>
        @foreach($emails as $slug => $pretty)
            <li>
                <a href="{{ route('dashboard.emails.iframe', ['slug' => $slug]) }}">{{ $pretty }}</a>
            </li>
        @endforeach
    </ul>
@endsection
