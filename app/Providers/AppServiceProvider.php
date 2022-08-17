<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //для пагинаций
        Paginator::useBootstrap();
        
        //для подсветки выбранного путнкта меню
        Blade::directive('route_active', function ($route) {
            return "<?php 
                if (Route::currentRouteNamed($route)) {
                    echo \"class='m-2 btn btn-dark'\";
                } else {
                    echo \"class='m-2 btn btn-secondary'\";
                }
            ?>";
        });
    }
}
