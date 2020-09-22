@extends('layouts.dashboard');

@section('dashboard-content')
    <a href="{{ route('dashboard.emails.index') }}">Back to all</a>
    <iframe style="width: 100%; min-height: 400px;" src="{{ route('dashboard.emails.' . Str::camel($emailSlug)) }}"></iframe>
@endsection
