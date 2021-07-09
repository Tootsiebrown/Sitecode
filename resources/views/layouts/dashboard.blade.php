@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection
@section('page-css')
    @yield('css')
@endsection
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

                @if (isset($message))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <div class="main-wrapper">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    @yield('js')
@endsection
