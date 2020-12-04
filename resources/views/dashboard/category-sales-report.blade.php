@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Category Sales Report</h1>

    <form class="form-horizontal" action="{{ route('dashboard.shop.orders.salesByCategory') }}" method="GET">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('dashboard.form-elements.form-group', [
            'name' => 'from',
            'prettyTitle' => 'From',
            'type' => 'date',
            'value' => $from,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'to',
            'prettyTitle' => 'to',
            'type' => 'date',
            'value' => $to,
        ])

        @include('dashboard.form-elements.form-group', ['type' => 'submit'])
    </form>

    <table class="dashboard-table">
        <thead>
            <tr>
                <td>Name</td>
                <td>Sales Quantity</td>
                <td>Sales Dollars</td>
            </tr>
        </thead>
        <tbody>
            @foreach($categories->filter(fn($category) => $category->parent_id === 0) as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td class="numeric">{{ $category->quantity_sold }}</td>
                    <td class="money">{{ Currency::format($category->dollars_sold) }}</td>
                </tr>
                @foreach($categories->filter(fn($middleCategory) => $middleCategory->parent_id === $category->id) as $middleCategory)
                    <tr>
                        <td class="indent">{{ $middleCategory->name }}</td>
                        <td class="numeric">{{ $middleCategory->quantity_sold }}</td>
                        <td class="money">{{ Currency::format($middleCategory->dollars_sold) }}</td>
                    </tr>
                    @foreach($categories->filter(fn($bottomCategory) => $bottomCategory->parent_id === $middleCategory->id) as $bottomCategory)
                        <tr>
                            <td class="double-indent">{{ $bottomCategory->name }}</td>
                            <td class="numeric">{{ $bottomCategory->quantity_sold }}</td>
                            <td class="money">{{ Currency::format($bottomCategory->dollars_sold) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection
