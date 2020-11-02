@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Carousel Slide</h1>

    <a href="{{ route('dashboard.carousel.index') }}">Back to All</a>
    <form action="{{ $action }}" method="POST" class="form-horizontal">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        @include('dashboard.form-elements.form-group', [
            'name' => 'title',
            'prettyTitle' => 'Title',
            'type' => 'text',
            'value' => $slide->title,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'url',
            'prettyTitle' => 'URL',
            'type' => 'text',
            'value' => $slide->url,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'caption',
            'prettyTitle' => 'Caption',
            'type' => 'text',
            'value' => $slide->caption,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'cta',
            'prettyTitle' => 'Button Text',
            'type' => 'text',
            'value' => $slide->cta,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'image',
            'prettyTitle' => 'Image',
            'type' => 'image',
            'value' => $slide->image->file,
            'imageMeta' => $slide->image_metadata,
            'path' => $slide->getFilePath('image'),
            'allowCrop' => false
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'background_image',
            'prettyTitle' => 'Backround Image',
            'type' => 'image',
            'value' => $slide->background_image->file,
            'imageMeta' => $slide->background_image_metadata,
            'path' => $slide->getFilePath('background_image'),
            'allowCrop' => false
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'Submit',
            'type' => 'submit',
        ])
    </form>
@endsection
