@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Edit Address</h1>

    <a href="{{ route('dashboard.shippingAddresses.index') }}">Back to All</a>
    <form class="form-horizontal" action="{{ route('dashboard.shippingAddresses.update', ['id' => $address->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'firstname',
            'prettyTitle' => 'First Name',
            'value' => $address->firstname,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'lastname',
            'prettyTitle' => 'Last Name',
            'value' => $address->lastname,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'email',
            'prettyTitle' => 'Email',
            'value' => $address->email,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'phone',
            'prettyTitle' => 'Phone',
            'value' => $address->phone,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'address1',
            'prettyTitle' => 'Address Line 1',
            'value' => $address->address1,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'address2',
            'prettyTitle' => 'Address Line 2',
            'value' => $address->address2,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'city',
            'prettyTitle' => 'City',
            'value' => $address->city,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'state',
            'prettyTitle' => 'State',
            'value' => $address->state,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'zip',
            'prettyTitle' => 'Zip',
            'value' => $address->zip,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'boolean',
            'name' => 'default_shipping',
            'prettyTitle' => 'Default',
            'checked' => $address->default_shipping,
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'submit',
        ])

    </form>
@endsection
