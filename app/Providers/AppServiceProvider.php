<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use App\Http\Middleware\CheckUserLastActive;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Contracts\Pagination\Paginator as entere;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {
        Paginator::useBootstrap();
        $router->pushMiddlewareToGroup('web', CheckUserLastActive::class);


    }
}
