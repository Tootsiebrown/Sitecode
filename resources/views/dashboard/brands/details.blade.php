@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Brand: {{ $brand->name }}</h1>

    <form class="form-horizontal" method="POST" action="{{ route('dashboard.brands.save', ['id' => $brand->id]) }}">
        @csrf

        @include('dashboard.shared.inputs.text', [
            'name' => 'name',
            'label' => 'Name',
            'defaultValue' => $brand->name,
        ])

        <div class="row">
            <label class="col-sm-3">&nbsp;</label>
            <div class="col-sm-8">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">
                    Update Brand
                </button>
            </div>
        </div>
    </form>

    <form class="form-horizontal" method="POST" action="{{ route('dashboard.brands.delete', ['id' => $brand->id]) }}">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <p>This brand has {{ $brand->listings->count() }} listings and {{ $brand->products->count() }} products</p>
        <hr>
        <button type="submit" name="delete" value="delete_only" class="btn btn-secondary">
            Just Delete This Brand
        </button>

        <p class="delete-or-move"><b>OR</b></p>

        <p>
            Move products/listings to
            <span class="select2-inline-container">
                <select name="move_to" class="select2">
                    @foreach ($allBrands as $possibleBrand)
                        <option value="{{ $possibleBrand->id }}">
                            {{ $possibleBrand->name }}
                        </option>
                    @endforeach
                </select>
            </span>
        </p>
        <p>
            And <i>then...</i>
            <button type="submit" name="delete" value="delete_and_move" class="btn btn-primary">
                Delete the Brand
            </button>
        </p>
    </form>

@endsection
