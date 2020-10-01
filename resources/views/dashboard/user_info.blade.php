@extends('layouts.dashboard')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')
    <div class="row">
        <div class="col-xs-12">

            <table class="table table-bordered table-striped">

                <tr>
                    <th>@lang('app.name')</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>@lang('app.user_name')</th>
                    <td>{{ $user->user_name }}</td>
                </tr>
                <tr>
                    <th>@lang('app.email')</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>@lang('app.gender')</th>
                    <td>{{ ucfirst($user->gender) }}</td>
                </tr>
                <tr>
                    <th>@lang('app.mobile')</th>
                    <td>{{ $user->mobile }}</td>
                </tr>
                <tr>
                    <th>@lang('app.phone')</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th>@lang('app.address')</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <th>@lang('app.country')</th>
                    <td>
                        @if($user->country)
                            {{ $user->country->country_name }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>@lang('app.website')</th>
                    <td>{{ $user->website }}</td>
                </tr>
                <tr>
                    <th>@lang('app.created_at')</th>
                    <td>{{ $user->signed_up_datetime() }}</td>
                </tr>
                <tr>
                    <th>@lang('app.status')</th>
                    <td>{{ $user->status_context() }}</td>
                </tr>
            </table>

            <form class="form-horizontal" method="GET" action="{{ route('dashboard.users.update', ['id' => $user->id]) }}">
                @csrf
                <div class="form-group {{ $errors->has('permissions')? 'has-error':'' }}">
                    <label for="permissions" class="col-sm-4 control-label">Permissions</label>
                    <div class="col-sm-8">
                        @foreach ($user->assignableGroups as $group)
                            <input
                                type="checkbox"
                                value="{{ $group->id }}"
                                name="permissions[]"
                                placeholder=""
                            >
                        @endforeach
                        {!! $errors->has('permissions')? '<p class="help-block">'.$errors->first('search').'</p>':'' !!}

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">Assign Permissions</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
