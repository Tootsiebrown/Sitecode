@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Categories</h1>

    @include ('dashboard.categories.list', [
        'categories' => $categories,
        'top' => true,
    ])
@endsection
