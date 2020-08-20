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


                <h2>Search by UPC</h2>
                <form class="form-horizontal" method="GET" action="{{ route('lister.index') }}">
                    <input type="hidden" name="search_by" value="upc">
                    <div class="form-group {{ $errors->has('upc')? 'has-error':'' }}">
                        <label for="state_name" class="col-sm-4 control-label">UPC</label>
                        <div class="col-sm-8">
                            <div data-component="barcode-reader">
                                <div class="input-group mb-3 focusable" data-component="focusable-input-group">
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="upc"
                                      value="{{ request('upc') }}"
                                      name="upc"
                                      placeholder=""
                                      data-element="input"
                                    >
                                    <span class="input-group-btn">
                                        <button
                                          class="btn btn-link"
                                          type="button"
                                          data-element="button"
                                        ><i class="fa fa-camera"></i></button>
                                    </span>
                                </div>
                            </div>
                            {!! $errors->has('upc')? '<p class="help-block">'.$errors->first('upc').'</p>':'' !!}

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>

                <h2>Search by Name</h2>
                <form class="form-horizontal" method="GET" action="{{ route('lister.index') }}">
                    <input type="hidden" name="search_by" value="name">

                    <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
                        <label for="name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" value="{{ request('name') }}" name="name" placeholder="">
                            {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>

                @if(! is_null($searchBy))
                    @if(! $products->isEmpty())
                        @include('dashboard.lister.product-suggestions', ['products' => $products])
                    @else
                        <p>@lang('app.there_is_no_products', ['search' => $searchString])</p>
                        <p>
                            <a
                                href="{{ route('lister.productForm', ['upc' => $upc, 'name' => $name]) }}"
                                class="btn btn-primary"
                            >Create New Product From Scratch</a>
                        </p>
                        <h2>Search Datafiniti</h2>
                        <form class="form-horizontal" method="POST" action="{{ route('lister.index') }}">
                            @csrf

                            <input type="hidden" name="upc" value="{{ $upc }}">
                            <input type="hidden" name="name" value="{{ $name }}">
                            <input type="hidden" name="search_by" value="{{ $searchBy }}">

                            <div class="form-group {{ $errors->has('datafiniti_upc')? 'has-error':'' }}">
                                <label for="datafiniti_upc" class="col-sm-4 control-label">UPC</label>
                                <div class="col-sm-8">
                                    <div data-component="barcode-reader">
                                        <div class="input-group mb-3">
                                            <input
                                              type="text"
                                              class="form-control"
                                              id="datafiniti_upc"
                                              value="{{ request('datafiniti_upc') ?? old('datafiniti_upc') ?? $upc ?? '' }}"
                                              name="datafiniti_upc"
                                              placeholder=""
                                              data-element="input"
                                            >
                                            <span class="input-group-btn">
                                                <button
                                                    class="btn btn-primary"
                                                    type="button"
                                                    data-element="button"
                                                ><i class="fa fa-camera"></i> &nbsp;Scan</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


{{--                            <div class="form-group {{ $errors->has('datafiniti_upc')? 'has-error' : '' }}">--}}
{{--                                <label for="datafiniti_upc" class="col-sm-4 control-label">UPC</label>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <input type="text"--}}
{{--                                           data-element="input" class="form-control" id="datafiniti_upc" value="{{ request('datafiniti_upc') ?? request('datafiniti_upc') ?? '' }}" name="datafiniti_upc" placeholder="">--}}
{{--                                    {!! $errors->has('datafiniti_upc')? '<p class="help-block">'.$errors->first('datafiniti_upc').'</p>':'' !!}--}}

{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>

                        @if(! $datafinitiProfiles->isEmpty())
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered table-striped table-responsive">

                                        @foreach($datafinitiProfiles as $key => $profile)
                                            <tr>
                                                <td>
                                                    {{ $profile["name"] }}
                                                    <hr />

                                                    <a
                                                      class="btn btn-primary"
                                                      href="{{ route('lister.productForm', ['name' => $profile['name'], 'upc' => $upc, 'from_profile' => $key]) }}"
                                                    >Create Product From This Profile</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        @elseif(!empty($datafinitiUpc) && $datafinitiProfiles->isEmpty())
                            <h2>No profiles were found for "{{ $datafinitiUpc }}"</h2>
                            <p>
                                <a
                                  href="{{ route('lister.productForm', ['upc' => $datafinitiUpc, 'name' => $name]) }}"
                                  class="btn btn-primary"
                                >Create New Product From Scratch</a>
                            </p>
                        @endif
                    @endif
                @endif
            </div>   <!-- /#page-wrapper -->

        </div>   <!-- /#wrapper -->


    </div> <!-- /#container -->
    @include('site.components.quagga-popup')
@endsection

@section('page-js')

    <script>
        $(document).ready(function() {
            $('.deleteAds').on('click', function () {
                if (!confirm('{{ trans('app.are_you_sure') }}')) {
                    return '';
                }
                var selector = $(this);
                var slug = selector.data('slug');
                $.ajax({
                    url: '{{ route('delete_ads') }}',
                    type: "POST",
                    data: {slug: slug, _token: '{{ csrf_token() }}'},
                    success: function (data) {
                        if (data.success == 1) {
                            selector.closest('tr').hide('slow');
                            toastr.success(data.msg, '@lang('app.success')', toastr_options);
                        }
                    }
                });
            });

            $('.approveAds, .blockAds').on('click', function () {
                var selector = $(this);
                var slug = selector.data('slug');
                var value = selector.data('value');
                $.ajax({
                    url: '{{ route('ads_status_change') }}',
                    type: "POST",
                    data: {slug: slug, value: value, _token: '{{ csrf_token() }}'},
                    success: function (data) {
                        if (data.success == 1) {
                            selector.closest('tr').hide('slow');
                            toastr.success(data.msg, '@lang('app.success')', toastr_options);
                        }
                    }
                });
            });
        });

    </script>

    <script>
        @if(session('success'))
            toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
        @endif
        @if(session('error'))
            toastr.error('{{ session('error') }}', '{{ trans('app.success') }}', toastr_options);
        @endif
    </script>

@endsection
