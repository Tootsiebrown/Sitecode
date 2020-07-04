<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    protected function authenticated(Request $request, $user)
    {
        if ($request->expectsJson()) {
            return response()->json($user, 200);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        if ($request->expectsJson()) {
            $request->session()->regenerateToken();
            return response()->json($this->tokenResponse(), 200);
        }

        return redirect('/');
    }

    public function tokenResponse()
    {
        return ['_token' => csrf_token()];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(
                new MessageBag(['_error' => ['Login Failed']]),
                422
            );
        }

        throw ValidationException::withMessages(
            [
                $this->username() => [trans('auth.failed')],
            ]
        );
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
