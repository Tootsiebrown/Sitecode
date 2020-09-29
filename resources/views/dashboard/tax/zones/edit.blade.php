@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Tax for {{ $zone->zone }}</h1>

    <form action="{{ route('dashboard.tax.zones.save', ['id' => $zone->id]) }}" class="form-horizontal" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="rate" class="col-sm-4 control-label">Rate (%)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="rate" value="{{ old('rate', $zone->rate) }}" name="rate">
            </div>
        </div>

        <div class="form-group">
            <label for="tax_shipping" class="col-sm-4 control-label">Tax Shipping?</label>
            <div class="col-sm-8">
                <input type="checkbox" id="tax_shipping" value="1" {{ old('tax_shipping', $zone->tax_shipping) ? 'checked' : '' }} name="tax_shipping">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Save Tax Settings</button>
            </div>
        </div>
    </form>
@endsection
