<?php

namespace App\Providers;

use App\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
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
