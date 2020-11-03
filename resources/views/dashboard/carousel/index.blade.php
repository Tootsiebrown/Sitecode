@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Carousel</h1>

    <a href="{{ route('dashboard.carousel.create') }}">Add Slide</a>
    <table class="dashboard-table">
        <thead>
            <tr>
                <th>Edit</th>
                <th>Title</th>
                <th>Background</th>
                <th>Foreground</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($slides as $slide)
                <tr>
                    <td><a href="{{ route('dashboard.carousel.edit', ['id' => $slide->id]) }}"><i class="fa fa-edit"></i></a></td>
                    <td>{{ $slide->title }}</td>
                    <td><img src="{{ $slide->image->url }}"></td>
                    <td><img src="{{ $slide->background_image->url }}"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
