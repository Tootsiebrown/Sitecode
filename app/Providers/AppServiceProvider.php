<?php

namespace App\Providers;

use App\Models\Listing;
use App\Option;
use App\Repositories\ListingsRepository;
use App\Support\Filters\FilterAggregatorContract;
use App\Support\Filters\Listings\ListingsFilterAggreggator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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

        Blade::directive('slick', function ($component) {
            return
                '<script src="/assets/js/vendor/slick.min.js"></script>' .
                '<script src="/assets/js/slick.js"></script>';
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

        Carbon::macro('wasOver24HoursAgo', function () {
            return Carbon::now()->subHours(24)->greaterThan($this);
        });

        Builder::macro('createdAtDaysAgoColumn', function ($column) {
            // using Carbon::now() for testability

            switch ($this->connection->getDriverName()) {
                case 'sqlite':
                    $this->whereRaw('(cast(julianday("' . Carbon::now()->toDateString() . '", "localtime") as int) - cast(julianday("created_at") as int)) = "' . $column . '"');
                    break;

                case 'mysql':
                    $this->whereRaw('DATEDIFF(' . Carbon::now()->toDateString() . ', created_at) = send_to_ebay_days');
                    break;

                default:
                    throw new Exception('This macro does not support the database driver you\'re using.');
                    break;
            }

            return $this;
        });
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
