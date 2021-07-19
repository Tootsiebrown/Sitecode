@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $page['title'] }}</h1>
        <div class="editable-content">
            {!! $page['content'] ?? '' !!}
            
        </div>
    </div>
    <div>
    </div>
@endsection
