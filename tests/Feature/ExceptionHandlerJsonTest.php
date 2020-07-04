<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\WaxAppTestCase;

class ExceptionHandlerJsonTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        // register test route(s)
        $this->registerBeforeBootstrappingCallback(
            BootProviders::class,
            $this->getRegisterRoutesClosure()
        );

        parent::setUp();
    }

    public function testTokenMismatchException()
    {
        // the CSRF check is bypassed when the app.env is 'testing', so this is how I force it to verify the token
        app()['env'] = 'none of the above';

        $response = $this->json('POST', '/echo', ['_token' => '...']);
        $response->assertStatus(400)
            ->assertJson(['_error' => ['Token Mismatch']]);
    }

    public function testAuthenticationException()
    {
        $response = $this->json('GET', '/authenticated');
        $response->assertStatus(401)
            ->assertJson(['_error' => ['Unauthenticated.']]);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->json('GET', '/authenticated');

        $response->assertStatus(200);
    }

    public function testAuthorizationException()
    {
        $response = $this->json('GET', '/unauthorized');
        $response->assertStatus(403)
            ->assertJson(['_error' => ['Unauthorized.']]);
    }

    public function testModelNotFoundException()
    {
        $this->markTestSkipped();

        $user = factory(User::class)->create();

        // test the route works for a valid model
        $response = $this->json('GET', '/user/'.$user->id);
        $response->assertStatus(200)
            ->assertJson(['id' => $user->id]);

        // test the exception is caught for an invalid id
        $response = $this->json('GET', '/user/777');
        $response->assertStatus(400)
            ->assertJson(['_error' => ['Bad Request']]);
    }


    protected function getRegisterRoutesClosure()
    {
        return function () {
            Route::middleware('web')
                ->group(function () {
                    Route::get('user/{user}', function (User $user) {
                        return response()->json($user);
                    });

                    Route::post('echo', function (Request $request) {
                        return response()->json($request->all());
                    });

                    Route::get('authenticated', function (Request $request) {
                        return response()->json($request->all());
                    })->middleware('auth');

                    Route::get('unauthorized', function () {
                        throw new AuthorizationException('nope');
                    });
                });
        };
    }
}
