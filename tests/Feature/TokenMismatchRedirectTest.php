<?php

namespace Tests\Feature;

use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Route;
use Tests\WaxAppTestCase;

class TokenMismatchRedirectTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        // register test route(s)
        $this->registerBeforeBootstrappingCallback(
            BootProviders::class,
            $this->getRegisterRoutesClosure()
        );

        parent::setUp();

        // the CSRF check is bypassed when the app.env is 'testing', so this is how I force it to verify the token
        app()['env'] = 'none of the above';

        // If there's an existing 'login' route, delete it so it doesn't interfere with the tests
        $newRouteCollection = new RouteCollection();
        foreach(Route::getRoutes() as $route) {
            if($route->getName() == 'login') {
                continue;
            }
            $newRouteCollection->add($route);
        }
        Route::setRoutes($newRouteCollection);
    }

    /**
     * If no Front-end login page exists, token mismatch should always redirect to admin login
     */
    public function testFrontEndUrlWithoutFrontendLoginPageRedirectsToAdminLogin()
    {
        // hit a url on the front-end
        $response = $this->post('/echo');
        $response->assertRedirect(route('admin::login'));
    }

    public function testAdminUrlWithoutFrontendLoginPageRedirectsToAdminLogin()
    {
        // hit an admin url
        $response = $this->post('/admin/echo');
        $response->assertRedirect(route('admin::login'));
    }

    /**
     * If there is a front-end login page, front-end urls should redirect to front-end login page, but
     * admin urls should still redirect to the admin login page
     */
    public function testFrontendUrlWithFrontendLoginPageRedirectsToFrontendLogin()
    {
        // frontend login route exists
        Route::any('login', ['as' => 'login']);

        // hit a url on the front-end
        $response = $this->post('/echo');
        $response->assertRedirect(route('login'));
    }


    public function AdminUrlWithFrontendLoginPageRedirectsToAdminLogin()
    {
        // frontend login route exists
        Route::any('login', ['as' => 'login']);

        // hit an admin url
        $response = $this->post('admin/echo');
        $response->assertRedirect(route('admin::login'));
    }

    protected function getRegisterRoutesClosure()
    {
        return function () {
            Route::middleware('web')
                ->group(function () {
                    Route::post('echo', function (Request $request) {
                        return response()->json($request->all());
                    });

                    Route::post('admin/echo', function (Request $request) {
                        return response()->json($request->all());
                    });

                    Route::any('admin/login', ['as' => 'admin::login']);
                });
        };
    }
}
