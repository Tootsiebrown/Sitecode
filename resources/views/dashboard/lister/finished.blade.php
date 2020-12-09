@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection


@section('content')

    <div class="container">

        <div id="wrapper">

            @include('dashboard.sidebar_menu')

            <div id="page-wrapper">
                @if( ! empty($title))
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"> {{ $title }}  </h1>
                        </div> <!-- /.col-lg-12 -->
                    </div> <!-- /.row -->
                @endif

                @include('dashboard.flash_msg')

                <div class="finished-listing">
                    <h1>{{ $listing->title }}</h1>
                    <p><a href="{{ route('lister.index') }}">Back to Make a New Listing</a></p>
                    <p><a href="{{ $listing->url }}">View New Listing</a></p>
                    <p><a href="{{ route('dashboard.bins.showListingBins', ['id' => $listing->id]) }}">Edit Bins</a></p>
                    <h3>Item IDs</h3>
                    <ul class="item-ids">
                        @foreach ($listing->items as $item)
                            <li>{{ $item->id }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
