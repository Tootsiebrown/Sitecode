<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\WaxAppTestCase;

class ApiExceptionHandlerJsonTest extends WaxAppTestCase
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

        $response = $this->json('POST', 'api/_test/echo', ['_token' => '...']);
        $response->assertStatus(400)
            ->assertJson(['_error' => ['Token Mismatch']]);
    }

    public function testAuthenticationException()
    {
        $response = $this->json('GET', 'api/_test/authenticated');
        $response->assertStatus(401)
            ->assertJson(['_error' => ['Unauthenticated.']]);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->json('GET', 'api/_test/authenticated');

        $response->assertStatus(200);
    }

    public function testAuthorizationException()
    {
        $response = $this->json('GET', 'api/_test/unauthorized');
        $response->assertStatus(403)
            ->assertJson(['_error' => ['Unauthorized.']]);
    }

    public function testModelNotFoundException()
    {
        $user = factory(User::class)->create();

        // test the route works for a valid model
        $response = $this->json('GET', 'api/_test/user/'.$user->id);
        $response->assertStatus(200)
            ->assertJson(['id' => $user->id]);

        // test the exception is caught for an invalid id
        $response = $this->json('GET', 'api/_test/user/777');
        $response->assertStatus(400)
            ->assertJson(['_error' => ['Bad Request']]);
    }


    protected function getRegisterRoutesClosure()
    {
        return function () {
            Route::middleware('web')
                ->group(function () {
                    Route::get('api/_test/user/{user}', function (User $user) {
                        return response()->json($user);
                    });

                    Route::post('api/_test/echo', function (Request $request) {
                        return response()->json($request->all());
                    });

                    Route::get('api/_test/authenticated', function (Request $request) {
                        return response()->json($request->all());
                    })->middleware('auth');

                    Route::get('api/_test/unauthorized', function () {
                        throw new AuthorizationException('nope');
                    });
                });
        };
    }
}
