@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Taxes collected for {{ $year }}</h1>

    @if ($prevYearUrl)
        <a href="{{ $prevYearUrl }}">Previous Year</a><br/>
    @endif

    @if ($nextYearUrl)
        <a href="{{ $nextYearUrl }}">Next Year</a><br/>
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
