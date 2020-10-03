<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RequiredPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $privilege)
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'))->with('error', trans('app.unauthorized_access'));
        }

        $user = Auth::user();

        if (! $user->hasPrivilege($privilege)) {
            return redirect(route('dashboard'))->with('error', trans('app.access_restricted'));
        }

        return $next($request);
    }
}
