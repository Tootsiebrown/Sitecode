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

                <div class="main-wrapper">
                    <h1>Item SKU: {{ $item->id }}</h1>

                    <p>
                        <a
                          href="{{ route('dashboard.bins.showListingBins', ['id' => $item->listing->id]) }}"
                        >
                            {{ $item->listing->title }}
                        </a>
                    </p>
                </div>

                <form action="{{ route('dashboard.bins.saveItemBin', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    <div class="form-group {{ $errors->has('bin')? 'has-error':'' }}">
                        <input
                          class="form-control"
                          type="text"
                          name="bin"
                          value="{{ old('bin') ?? $item->bin }}"
                          autofocus
                          data-component="auto-select-on-focus"
                        >
                        {!! $errors->has('bin')? '<p class="help-block">'.$errors->first('bin').'</p>':'' !!}
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-primary">
                        Update Bin
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
