@extends('layouts.app')

@section('content')

    <div class="container">

    <div id="wrapper">

        @include('dashboard.sidebar_menu')

        <div id="page-wrapper">

            @if(session('error'))
                <div class="row">
                    <div class="col-lg-12">
                        <br />
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@lang('app.dashboard')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <div class="row">
                @if($lUser->isAdmin())
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="huge">{{ $approved_ads }}</div>
                                    <div>@lang('app.approved_ads')</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="huge">{{ $total_users }}</div>
                                    <div>@lang('app.users')</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="huge">{{ $total_payments }}</div>
                                    <div>@lang('app.success_payments')</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="huge">  {{ $total_payments_amount }} <sup>{{ get_option('currency_sign') }}</sup></div>
                                    <div>@lang('app.total_payment')</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <!-- /.row -->


        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    </div> <!-- /#container -->
@endsection
