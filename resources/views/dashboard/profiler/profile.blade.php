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


                <h2>Barcode Search</h2>
                    <form class="form-horizontal" method="POST" action="{{ route('profiler.index') }}">
                        @csrf

                        <div class="form-group {{ $errors->has('search')? 'has-error':'' }}">
                            <label for="state_name" class="col-sm-4 control-label">Barcode</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="search" value="{{ request('search') }}" name="search" placeholder="">
                                {!! $errors->has('search')? '<p class="help-block">'.$errors->first('search').'</p>':'' !!}

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                @if(!empty($profiles))
                    <div class="row">
                        <div class="col-xs-12">


                            @if($profiles->count() > 0)
                                <table class="table table-bordered table-striped table-responsive">

                                    @foreach($profiles as $profile)
                                        <tr>
                                            <td>
                                                {{ $profile["name"] }}
                                                <hr />

                                                <form action="{{ route('profiler.saveProduct') }}" id="listingPostForm" class="form-horizontal" method="post" enctype="multipart/form-data"> @csrf
                                                    <input type="hidden" value="{{ $profile['name'] }}" name="name">
                                                    <input type="hidden" value="{{ $profile['upc'] }}" name="upc">
                                                    <button type="submit" class="btn btn-primary">Create Product From This Profile</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            @else
                                <h2>No profiles were found for "{{ $search }}"</h2>
                                <p>
                                    <a href="{{ route('profiler.newProduct') }}" class="btn btn-primary">Create New Product From Scratch</a>
                                </p>
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
