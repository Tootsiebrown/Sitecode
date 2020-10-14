<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
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
     * Show the application's login form.
     */
    public function showLoginForm()
    {
        if (empty(session()->get('url.intended'))) {
            session(['url.intended' => url()->previous()]);
        }
        $this->redirectTo = session()->get('url.intended');

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (get_option('enable_recaptcha_login') == 1) {
            $this->validate($request, array('g-recaptcha-response' => 'required'));

            $secret = get_option('recaptcha_secret_key');
            $gRecaptchaResponse = $request->input('g-recaptcha-response');
            $remoteIp = $request->ip();

            $recaptcha = new \ReCaptcha\ReCaptcha($secret);
            $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
            if (! $resp->isSuccess()) {
                return redirect()->back()->with('error', 'reCAPTCHA is not verified');
            }
        }

        //Check if active account
//        $user = User::whereEmail($request->email)->first();
//        if ($user) {
//            if ($user->active_status != '1') {
//                return redirect()->back()->with('error', trans('app.user_account_wrong'));
//            }
//        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

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

        return redirect()->intended($this->redirectPath());
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
