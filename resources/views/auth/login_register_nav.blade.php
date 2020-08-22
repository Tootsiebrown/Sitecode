<ul class="nav nav-pills">
    <li role="presentation" class="@if (Route::current()->getName() === 'login') active @endif"><a href="{{ route('login') }}">@lang('app.login')</a></li>
    <li role="presentation" class="@if (Route::current()->getName() === 'register') active @endif"><a href="{{ route('register') }}">@lang('app.register')</a></li>
</ul>
