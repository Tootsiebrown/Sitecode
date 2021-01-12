@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Category: {{ $category->name }}</h1>
    <p>{{ $breadcrumb }}</p>

    <form class="form-horizontal" action="{{ route('dashboard.categories.save', ['id' => $category->id]) }}" method="POST">
        @csrf

        @include('dashboard.form-elements.form-group', [
            'name' => 'name',
            'prettyTitle' => 'Name',
            'value' => old('name', $category->name),
            'type' => 'text',
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'submit'
        ])
    </form>

    <form class="form-horizontal" method="POST" action="{{ route('dashboard.categories.delete', ['id' => $category->id]) }}">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <p>This category has {{ $category->listings->count() }} listings, {{ $category->products->count() }} products, and {{ $category->children->count() }} children.</p>
        <hr>
        <button type="submit" name="delete" value="delete_only" class="btn btn-secondary">
            Just Delete This Category
        </button>

        <p class="delete-or-move"><b>OR</b></p>

        <p>
            Move products/listings/children to
            <span class="select2-inline-container">
                <select name="move_to" class="select2">
                    @foreach ($peerCategories as $possibleCategory)
                        <option value="{{ $possibleCategory->id }}">
                            {{ $possibleCategory->name }}
                        </option>
                    @endforeach
                </select>
            </span>
        </p>
        <p>
            And <i>then...</i>
            <button type="submit" name="delete" value="delete_and_move" class="btn btn-primary">
                Delete the Category
            </button>
        </p>
    </form>

    @include ('dashboard.categories.list', ['categories' => $children])
@endsection
