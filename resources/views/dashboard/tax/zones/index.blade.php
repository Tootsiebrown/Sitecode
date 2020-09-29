@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Tax Table</h1>

    <table class="dashboard-table">
        <thead>
            <tr>
                <th>State</th>
                <th>Rate</th>
                <th>Shipping</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($zones as $zone)
                <tr>
                    <td>{{ $zone->zone }}</td>
                    <td>{{ $zone->rate }}%</td>
                    <td>{{ $zone->tax_shipping ? 'yes' : 'no' }}</td>
                    <td>
                        <a href="{{ route('dashboard.tax.zones.show', ['id' => $zone->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
