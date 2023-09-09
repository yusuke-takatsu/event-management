<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->mapApiV1Routes();

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * @return void
     */
    protected function mapApiV1Routes(): void
    {
        $routes = function () {
            Route::prefix('api/v1')
                ->as('api.')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        };

        Route::domain(config('domain.app_domain'))
            ->group($routes);

        Route::domain(config('domain.nginx_domain'))
            ->group($routes);
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
