@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Promo Code: {{ $coupon->title }}</h1>
    <a href="{{ route('dashboard.promoCodes.index') }}">Back to All</a>
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
                'value' => number_format($coupon->dollars, 2, ".", ""),
            ])

            @include('dashboard.form-elements.form-group', [
                'name' => 'percent',
                'prettyTitle' => 'Percent Off',
                'type' => 'text',
                'value' => $coupon->percent,
            ])
        </div>

        @include('dashboard.form-elements.form-group', [
            'name' => 'expired_at',
            'prettyTitle' => 'Expiration',
            'type' => 'date',
            'value' => $coupon->expired_at,
        ])

        @include('dashboard.form-elements.form-group', [
            'name' => 'minimum_order',
            'prettyTitle' => 'Minimum Order',
            'type' => 'text',
            'value' => $coupon->minimum_order ? number_format($coupon->minimum_order, 2, ".", "") : null,
        ])

        <div data-component="dashboard-coupon-usage-restrictions">
            @include('dashboard.form-elements.form-group', [
                'name' => 'usage_restrictions',
                'prettyTitle' => 'Usage Restriction',
                'type' => 'select',
                'value' => !$coupon->exists
                    ? 'one_time'
                    : $coupon->usability,
                'options' => [
                    'one_time' => 'One time',
                    'once_per_user' => 'Once Per User',
                    'reusable' => 'Reusable',
                ]
            ])

            @include('dashboard.form-elements.form-group', [
                'name' => 'permitted_uses',
                'prettyTitle' => 'Number of Uses',
                'type' => 'text',
                'value' => $coupon->permitted_uses,
                'note' => 'Leave blank for unlimited uses.'
            ])
        </div>

        @include('dashboard.form-elements.form-group', [
            'name' => 'include_shipping',
            'prettyTitle' => 'Include Shipping',
            'type' => 'boolean',
            'checked' => $coupon->exists ? $coupon->include_shipping : true,
        ])

        <div data-component="dashboard-coupon-applicability-restrictions">
            <input type="hidden" name="which" data-element="which" value="{{ $which }}">

           <div data-element="categoryWrapper">
                @php
                    $categoryOptions = \App\Models\ProductCategory::orderBy('breadcrumb')
                            ->get()
                            ->mapWithKeys(function ($category) {
                                return [$category->id => $category->breadcrumb];
                            })
                            ->prepend('Any & All', '')
                            ->toArray();
                @endphp

                @include('dashboard.form-elements.form-group', [
                    'name' => 'category_id',
                    'prettyTitle' => 'Category',
                    'type' => 'select',
                    'value' => $coupon->category_id,
                    'options' => $categoryOptions,
                ])
           </div>

            <div data-element="listingWrapper">
                @php
                    $listingOptions = \App\Models\Listing::orderBy('title')
                            ->get()
                            ->mapWithKeys(function ($listing) {
                                return [$listing->id => $listing->title];
                            })
                            ->prepend('Any & All', '')
                            ->toArray();
                @endphp

                @include('dashboard.form-elements.form-group', [
                    'name' => 'listing_id',
                    'prettyTitle' => 'Listing',
                    'type' => 'select',
                    'value' => $coupon->listing_id,
                    'options' => $listingOptions,
                ])
            </div>

        </div>

        @include('dashboard.form-elements.form-group', [
            'type' => 'submit',
        ])
    </form>

    @if ($coupon->exists)
        <form action="{{ route('dashboard.promoCodes.destroy', ['id' => $coupon->id]) }}" method="POST" class="form-horizontal">
            @csrf
            @method('DELETE')
            @include('dashboard.form-elements.form-group', [
                'type' => 'submit',
                'prettyTitle' => 'Delete',
            ])
        </form>
    @endif
@endsection

