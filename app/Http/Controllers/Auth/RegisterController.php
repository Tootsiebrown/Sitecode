<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Wax\Core\Contracts\AuthorizationRepositoryContract;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if (get_option('enable_recaptcha_registration') == 1) {
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

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($request->input('back', $this->redirectPath()));
    }

    /**
     * Show the application registration form.
     *
     */
    public function showRegistrationForm(Request $request)
    {
        return view('auth.register', [
            'back' => $request->input('back'),
        ]);
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $authRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorizationRepositoryContract $authRepo)
    {
        $this->middleware('guest');
        $this->authRepo = $authRepo;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if ($request->expectsJson()) {
            return response()->json($user, 200);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'newsletter_subscription' => ['boolean']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'firstname' => $data['firstName'],
            'lastname' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'newsletter_subscription' => isset($data['newsletter_subscription']) && $data['newsletter_subscription'],
        ]);

        $group = $this->authRepo->getGroup('Member');
        if ($group) {
            $user = $this->authRepo->addUserToGroup($user, $group);
        }

        return $user->fresh();
    }
}
