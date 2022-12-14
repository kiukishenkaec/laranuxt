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
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * If specified, this namespace is automatically applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        Route::middleware('api')
            ->group(base_path('routes/api.php'));

        Route::prefix('api/v1/admin/binance')
            ->namespace('\\App\\Http\\Controllers\\API\\V1\\Admin\\Binance')
            ->name('api.v1.admin.binance.')
            ->group(base_path('routes/API/V1/Binance/admin.php'));

        Route::prefix('api/v1/binance')
            ->namespace('\\App\\Http\\Controllers\\API\\V1\\Binance')
            ->name('api.v1.binance.')
            ->group(base_path('routes/API/V1/Binance/public.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}
