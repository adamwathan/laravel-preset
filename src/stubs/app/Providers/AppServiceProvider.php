<?php
namespace App\Providers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CaptureRequestExtension;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::macro('multiformat', function () {
            return $this->setUri($this->uri() . '.{_format?}');
        });

        Request::macro('match', function ($responses, $defaultFormat = 'html') {
            return value(array_get($responses, $this->route()->parameter('_format', $this->format($defaultFormat)), function () {
                abort(404);
            }));
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}