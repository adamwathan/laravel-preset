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
            $this->uri = $this->uri . '.{_extension?}';
            return $this;
        });
        Request::macro('match', function ($responses, $defaultFormat = 'html') {
            if ($this->route()->parameter('_extension') !== null) {
                return value(array_get($responses, $this->route()->parameter('_extension'), function () {
                    abort(404);
                }));
            }
            return value(array_get($responses, $this->format($defaultFormat)));
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