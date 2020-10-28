@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Payment Methods</h1>

    <table class="dashboard-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Last 4 Digits</th>
                <th>Brand</th>
                <th>Zip</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentMethods as $paymentMethod)
                <tr>
                    <td>{{ $paymentMethod->firstname }} {{ $paymentMethod->lastname }}</td>
                    <td class="center">{{ $paymentMethod->masked_card_number }}</td>
                    <td >{{ $paymentMethod->brand }}</td>
                    <td>{{ $paymentMethod->zip }}</td>
                    <td class="center">
                        <a
                          data-component="confirm-link"
                          data-message="Are you sure you want to delete this payment method? This cannot be undone."
                          href="{{ route('dashboard.paymentMethods.destroy', ['id' => $paymentMethod->id]) }}"
                        >
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
