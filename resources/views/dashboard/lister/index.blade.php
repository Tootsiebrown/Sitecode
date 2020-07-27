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


                <h2>Product Search</h2>
                    <form method="POST" action="{{ route('lister.index') }}">
                        @csrf

                        <div class="form-group {{ $errors->has('state_name')? 'has-error':'' }}">
                            <label for="state_name" class="col-sm-4 control-label">UPC</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="search" value="{{ old('search') }}" name="search" placeholder="">
                                {!! $errors->has('search')? '<p class="help-block">'.$errors->first('search').'</p>':'' !!}

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                @if(!empty($products))
                    <div class="row">
                        <div class="col-xs-12">


                            @if($products->total() > 0)
                                <table class="table table-bordered table-striped table-responsive">

                                    @foreach($products as $product)
                                        <tr>
                                            <td width="100">
                                                <img src="{{ media_url($product->feature_img) }}" class="thumb-listing-table" alt="">
                                            </td>
                                            <td>
                                                {{ $product-> name }}
                                                <hr />

                                                <a href="{{ route('lister.newListing', $product->id) }}" class="btn btn-primary">Create Listing For This Product</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            @else
                                <h2>@lang('app.there_is_no_products', ['search' => $search])</h2>
                                <form method="POST" action="{{ route('lister.newProduct') }}">
                                    @csrf

                                    <div class="form-group {{ $errors->has('state_name')? 'has-error':'' }}">
                                        <label for="state_name" class="col-sm-4 control-label">Product Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" placeholder="">
                                            {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
                                        </div>
                                        <label for="state_name" class="col-sm-4 control-label">UPC</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="upc" value="{{ old('upc') ?? $search }}" name="upc" placeholder="">
                                            {!! $errors->has('upc')? '<p class="help-block">'.$errors->first('upc').'</p>':'' !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Save Product &amp; Create Listing</button>
                                        </div>
                                    </div>
                                </form>
                            @endif


                        </div>
                    </div>
                    @endif

            </div>   <!-- /#page-wrapper -->

        </div>   <!-- /#wrapper -->


    </div> <!-- /#container -->
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
