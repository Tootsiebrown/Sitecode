<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($request->expectsJson()) {
                return response()->json(
                    new MessageBag(['_error' => ['Already Authenticated.']]),
                    400
                );
            }
dd('uhhhhh');
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
