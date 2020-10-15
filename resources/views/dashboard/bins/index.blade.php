@extends('layouts.dashboard')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')
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
                    data-component="auto-select-on-focus"
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
@endsection
