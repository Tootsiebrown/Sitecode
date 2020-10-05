<?php

namespace App\Providers;

use App\Models\Listing;
use App\Option;
use App\Repositories\ListingsRepository;
use App\Support\Filters\FilterAggregatorContract;
use App\Support\Filters\Listings\ListingsFilterAggreggator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Blade::directive('render', function ($component) {
            return "<?php echo (app($component))->toHtml(); ?>";
        });

        Blade::directive('svg', function ($component) {
            return "<?php include(public_path('assets/img/" . $component . ".svg')) ?>";
        });

        $this->app->when(ListingsRepository::class)
            ->needs(Model::class)
            ->give(Listing::class);

        $this->app->when(ListingsRepository::class)
            ->needs(FilterAggregatorContract::class)
            ->give(ListingsFilterAggreggator::class);

        $this->app->bind(
            'Wax\SiteSearch\Contracts\SiteSearchRepositoryContract',
            'App\Repositories\SiteSearchRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if ($this->app->environment('local')) {
            if ($request->server->has('HTTP_X_ORIGINAL_HOST')) {
                $request->server->set('HTTP_X_FORWARDED_HOST', $request->server->get('HTTP_X_ORIGINAL_HOST'));
                $request->headers->set('X_FORWARDED_HOST', $request->server->get('HTTP_X_ORIGINAL_HOST'));
            }
        }
        load_options();

        view()->composer('*', function ($view) {
            $loggedUser = null;
            if (Auth::check()) {
                $loggedUser = Auth::user();
            }

            $current_lang = current_language();

            $view->with(['lUser' => $loggedUser, 'current_lang' => $current_lang]);
        });
    }
}
