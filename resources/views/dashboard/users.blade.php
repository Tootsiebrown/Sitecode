@extends('layouts.dashboard')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')
    <div class="row">
        <div class="col-xs-12">

            <form class="form-horizontal" method="GET" action="{{ route('users') }}">
                <div class="form-group {{ $errors->has('searh')? 'has-error':'' }}">
                    <label for="search" class="col-sm-4 control-label">Email or Name</label>
                    <div class="col-sm-8">
                        <input
                            type="text"
                            class="form-control"
                            id="search"
                            value="{{ request('search') }}"
                            name="search"
                            placeholder=""
                        >
                        {!! $errors->has('search')? '<p class="help-block">'.$errors->first('search').'</p>':'' !!}

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-striped" >
                <tr>
                    <th>@lang('app.name')</th>
                    <th>@lang('app.email')</th>
                    <th>@lang('app.created_at')</th>
                </tr>

                @foreach($users as $user)
                    <tr>
                        <td><a href="{{route('user_info', $user->id)}}">{{$user->name}}</a></td>
                        <td>{!! $user->email !!}</td>
                        <td>{!! $user->signed_up_datetime() !!}</td>
                    </tr>
                @endforeach
            </table>

            {!! $users->links() !!}
        </div>
    </div>
@endsection
