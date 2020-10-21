@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Promo Code: {{ $coupon->title }}</h1>

    <form action="{{ $action }}" method="POST" class="form-horizontal">
        @csrf
        @method($method)

        @include('dashboard.form-elements.form-group', [
            'name' => 'title',
            'prettyTitle' => 'Title',
            'type' => 'text',
            'value' => $coupon->title,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'code',
            'prettyTitle' => 'Code',
            'type' => 'text',
            'value' => $coupon->code,
        ])

        <div data-component="dashboard-coupon-type">
            @include ('dashboard.form-elements.form-group', [
                'name' => 'type',
                'prettyTitle' => 'Type',
                'value' => $coupon->percent ? 'percent' : 'dollars',
                'type' => 'select',
                'options' => [
                    'percent' => 'Percent',
                    'dollars' => 'Dollars',
                ],
            ])

            @include('dashboard.form-elements.form-group', [
                'name' => 'dollars',
                'prettyTitle' => 'Dollars Off',
                'type' => 'text',
                'value' => $coupon->dollars,
            ])

            @include('dashboard.form-elements.form-group', [
                'name' => 'percent',
                'prettyTitle' => 'Percent Off',
                'type' => 'text',
                'value' => $coupon->percent,
            ])
        </div>

        @include('dashboard.form-elements.form-group', [
            'name' => 'minimum_order',
            'prettyTitle' => 'Minimum Order',
            'type' => 'text',
            'value' => $coupon->minimum_order,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'one_time',
            'prettyTitle' => 'One Time',
            'type' => 'boolean',
            'checked' => $coupon->one_time,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'include_shipping',
            'prettyTitle' => 'Include Shipping',
            'type' => 'boolean',
            'checked' => $coupon->exists ? $coupon->one_time : true,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'submit',
        ])
    </form>
@endsection

