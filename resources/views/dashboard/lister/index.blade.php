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

                <h2>Search by SKU</h2>
                <form class="form-horizontal" method="GET" action="{{ route('lister.index') }}">
                    <input type="hidden" name="search_by" value="sku">

                    <div class="form-group {{ $errors->has('sku')? 'has-error':'' }}">
                        <label for="sku" class="col-sm-4 control-label">SKU</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="sku" value="{{ request('sku') }}" name="sku" placeholder="">
                            {!! $errors->has('sku')? '<p class="help-block">'.$errors->first('sku').'</p>':'' !!}
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
                        <h2>Suggestions</h2>
                        @include('dashboard.lister.product-suggestions', ['products' => $products])
                    @else
                        <p>@lang('app.there_is_no_products', ['search' => $searchString])</p>
                        <p>
                            <a
                                href="{{ route('lister.productForm', ['upc' => $upc, 'name' => $name]) }}"
                                class="btn btn-primary"
                            >Create New Product From Scratch</a>
                        </p>
                    @endif
                @endif
            </div>   <!-- /#page-wrapper -->

        </div>   <!-- /#wrapper -->


    </div> <!-- /#container -->
    @include('site.components.quagga-popup')
@endsection

@section('page-js')
    <script>
        @if(session('success'))
            toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
        @endif
        @if(session('error'))
            toastr.error('{{ session('error') }}', '{{ trans('app.success') }}', toastr_options);
        @endif
    </script>

@endsection
