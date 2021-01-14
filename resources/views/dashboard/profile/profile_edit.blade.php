@extends('layouts.dashboard')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')
    <form action="{{ route('profile_edit') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'firstname',
            'prettyTitle' => 'First Name',
            'value' => old('firstname', $user->firstname),
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'text',
            'name' => 'lastname',
            'prettyTitle' => 'Last Name',
            'value' => old('lastname', $user->lastname),
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'email',
            'name' => 'email',
            'prettyTitle' => trans('app.email'),
            'value' => old('email', $user->email),
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'boolean',
            'name' => 'newsletter_subscription',
            'prettyTitle' => 'Newsletter',
            'secondaryLabel' => 'Subscribed',
            'checked' => old('newsletter_subscription', $user->newsletter_subscription),
        ])

        @include('dashboard.form-elements.form-group', [
            'type' => 'submit',
        ])

    </form>
@endsection
