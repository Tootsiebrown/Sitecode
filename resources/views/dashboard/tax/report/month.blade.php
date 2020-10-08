@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Taxes collected for {{ $year }}-{{ $month }}</h1>

    <a href="{{ $yearUrl }}">See full year</a>
    @if ($prevMonthUrl)
        <br><a href="{{ $prevMonthUrl }}">Previous Month</a>
    @endif
    @if ($nextMonthUrl)
        <br><a href="{{ $nextMonthUrl }}">Next Month</a>
    @endif
    <table class="dashboard-table">
        <thead>
            <tr>
                <th>State / Rate</th>
                <th>Tax collected</th>
            </tr>
        </thead>
        <tbody>
            @foreach($zones as $zone => $amount)
                <tr>
                    <td>{{ $zone }}</td>
                    <td class="money">${{ $amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
