@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Brands</h1>

    <form class="form-horizontal" method="GET" action="{{ route('dashboard.brands.index') }}">
        <div class="form-group {{ $errors->has('search')? 'has-error':'' }}">
            <label for="search" class="col-sm-4 control-label">Search</label>
            <div class="col-sm-8">
                <input
                    type="text"
                    class="form-control"
                    id="search"
                    value="{{ request('search') }}"
                    name="search"
                    placeholder=""
                >
                {!! $errors->has('search')? '<p class="help-block">'.$errors->first('search').'</p>':'' !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <table class="dashboard-table">
        <tr>
            <th>Name</th>
            <th>Edit</th>
        </tr>
        @forelse($brands as $brand)
            <tr>
                <td>{{ $brand->name }}</td>
                <td><a href="{{ route('dashboard.brands.show', ['id' => $brand->id]) }}">Edit</a></>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    No brands found
                </td>
            </tr>
        @endforelse
    </table>

    {!! $brands->appends(['search' => request('search')])->links() !!}
@endsection
