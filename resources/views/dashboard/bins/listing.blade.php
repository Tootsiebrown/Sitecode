@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection


@section('content')

    <div class="container">

        <div id="wrapper">

            @include('dashboard.sidebar_menu')

            <div id="page-wrapper">
                @if( ! empty($title))
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"> {{ $title }}  </h1>
                        </div> <!-- /.col-lg-12 -->
                    </div> <!-- /.row -->
                @endif

                @include('dashboard.flash_msg')

                <div class="main-wrapper">
                    <h1>Edit Bins</h1>
                    <h2>{{ $listing->title }}</h2>
                    <p>Listing SKU: {{ $listing->id }}</p>
                    <p>Product SKU: {{ $listing->product_id }}</p>

                    <form
                      method="POST"
                      action="{{ route('dashboard.bins.bulkEditListingBins') }}"
                      data-component="listing-bin-bulk-editor"
                      class="bulk-edit-listing-bins form-horizontal"
                    >
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">

                        <button data-element="opener" class="btn btn-default">
                            Bulk Edit Bins
                        </button>



                        <div class="hidden" data-element="collapsibleSection">
                            <div class="form-group {{ $errors->has('listing_bulk_bin')? 'has-error':'' }}">
                                <label for="listing_bulk_bin" class="col-sm-3 control-label">
                                    Bin for all items:
                                </label>
                                <div class="col-sm-8">
                                    <input
                                      class="form-control"
                                      type="text"
                                      name="listing_bulk_bin"
                                      value="{{ old('listing_bulk_bin') ?? '' }}"
                                      id="listing_bulk_bin"
                                    >
                                    {!! $errors->has('listing_bulk_bin')? '<p class="help-block">'.$errors->first('listing_bulk_bin').'</p>':'' !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <!-- just for alignment -->
                                </label>
                                <div class="col-sm-8">
                                    <button class="btn btn-primary" name="submit" value="submit">
                                        Override all
                                    </button>
                                    <button data-element="closer" class="btn btn-default">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('dashboard.bins.saveListingBins', ['id' => $listing->id]) }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="listing-bins">
                            <tr>
                                <th>
                                    Item SKU
                                </th>
                                <th>
                                    Bin
                                </th>
                                <th>
                                    Sold
                                </th>
                                <th>
                                    <!-- nothing here -->
                                </th>
                            </tr>
                            @foreach ($listing->items as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        <div class="form-group {{ $errors->has('bin.' . $item->id)? 'has-error':'' }}">
                                            <input
                                              class="form-control"
                                              type="text"
                                              name="bin[{{$item->id}}]"
                                              value="{{ old('bin.' . $item->id) ?? $item->bin }}"
                                            >
                                            {!! $errors->has('bin.' . $item->id)? '<p class="help-block">'.$errors->first('bin.' . $item->id).'</p>':'' !!}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->order_item_id)
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                    @if ($loop->first)
                                        <td rowspan="{{ $listing->items->count() }}" style="vertical-align: top;">
                                            <button
                                              type="submit"
                                              name="submit"
                                              value="submit"
                                              class="btn btn-primary sticky-thing"
                                            >
                                                Update bins
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
