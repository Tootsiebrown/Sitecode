@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Shipping Addresses</h1>

    <table class="dashboard-table">
        <thead>
            <tr>
                <th>Edit</th>
                <th>Name</th>
                <th>Address Line 1</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Default</th>
            </tr>
        </thead>
        <tbody>
            @foreach($addresses as $address)
                <tr>
                    <td>
                        <a href="{{ route('dashboard.shippingAddresses.show', ['id' => $address->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td>{{ $address->firstname }} {{ $address->lastname }}</td>
                    <td>{{ $address->address1 }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->state }}</td>
                    <td>{{ $address->zip }}</td>
                    <td>{{ $address->default_shipping ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
