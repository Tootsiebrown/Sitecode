<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Support\Facades\Route;
use Tests\WaxAppTestCase;
use Wax\Core\Support\ConfigurationDatabase;

class AuthenticationJsonTest extends WaxAppTestCase
{
    /* @var \Faker\Generator */
    protected $faker;

    public function setUp(): void
    {
        // register test route(s)
        $this->registerBeforeBootstrappingCallback(
            BootProviders::class,
            $this->getRegisterRoutesClosure()
        );

        parent::setUp();

        app()->bind(ConfigurationDatabase::class, function () {
            $double = \Mockery::mock(ConfigurationDatabase::class);
            $double->shouldReceive('get')
                ->with('USERS_MASTER_KEY')
                ->andReturn('not a real key');
            return $double;
        });

        $this->faker = Factory::create();
    }

    public function testAuthenticatedResponse()
    {
        $this->markTestSkipped();

        $password = 'super secret';
        $user = factory(User::class)->create(['password' => bcrypt($password)]);

        $response = $this->json('POST', '/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200)
            ->assertJson(['email' => $user->email]);
    }

    public function testRegisteredResponse()
    {
        $password = $this->faker->asciify('************');
        $user = [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail,
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $response = $this->json('POST', '/register', $user);
        $response->assertStatus(200)
            ->assertJson(['email' => $user['email']]);
    }

    public function testLoginFailedResponse()
    {
        $password = 'super secret';
        $user = factory(User::class)->create(['password' => bcrypt($password)]);

        $response = $this->json('POST', '/login', [
            'email' => $user->email,
            'password' => 'Well this aint right',
        ]);
        $response->assertStatus(422)
            ->assertJson(['_error' => ['Login Failed']]);
    }

    public function testLogoutResponse()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->json('GET', '/logout');

        $response->assertStatus(200)
            ->assertJsonStructure(['_token']);
    }

    public function testRedirectIfAuthenticated()
    {
        $response = $this->json('GET', '/guest');
        $response->assertStatus(200);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->json('GET', '/guest');

        $response->assertStatus(400)
            ->assertJson(['_error' => ['Already Authenticated.']]);;
    }

    protected function getRegisterRoutesClosure()
    {
        return function () {
            Route::middleware('web')
                ->group(function () {
                    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
                    Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');
                    Route::post('register', '\App\Http\Controllers\Auth\RegisterController@register');

                    Route::get('guest', function() {
                        return 'Hello, world.';
                    })->middleware('guest');
                });
        };
    }
}
