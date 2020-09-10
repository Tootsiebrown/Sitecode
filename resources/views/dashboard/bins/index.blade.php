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

                @if ($message)
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <div class="main-wrapper">
                    <h2>Search by Listing SKU</h2>
                    <form class="form-horizontal" method="GET" action="{{ route('dashboard.bins.index') }}">
                        <input type="hidden" name="search_by" value="listing_sku">
                        <div class="form-group {{ $errors->has('listing_sku')? 'has-error':'' }}">
                            <label for="listing_sku" class="col-sm-4 control-label">Listing SKU</label>
                            <div class="col-sm-8">
                                <input
                                  type="text"
                                  class="form-control"
                                  id="listing_sku"
                                  value="{{ request('listing_sku') }}"
                                  name="listing_sku"
                                  placeholder=""
                                >
                                {!! $errors->has('listing_sku')? '<p class="help-block">'.$errors->first('listing_sku').'</p>':'' !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                    <h2>Search by Item SKU</h2>
                    <form class="form-horizontal" method="GET" action="{{ route('dashboard.bins.index') }}">
                        <input type="hidden" name="search_by" value="item_sku">
                        <div class="form-group {{ $errors->has('item_sku')? 'has-error':'' }}">
                            <label for="item_sku" class="col-sm-4 control-label">Item SKU</label>
                            <div class="col-sm-8">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item_sku"
                                    value="{{ request('item_sku') }}"
                                    name="item_sku"
                                    placeholder=""
                                    autofocus
                                >
                                {!! $errors->has('item_sku')? '<p class="help-block">'.$errors->first('item_sku').'</p>':'' !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
