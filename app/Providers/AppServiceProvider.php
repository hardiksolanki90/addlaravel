<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request as AppRequest;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(AppRequest $request)
    {
        Schema::defaultStringLength(191);
        $path_array = Request::segments();
        if (in_array(config('adlara.admin_route'), $path_array)) {
        $paths = [
          resource_path('admin/' . config('adlara.admin_theme') . '/templates')
        ];
        config(['view.paths' => $paths]);
        config(['adlara.app_scope' => 'admin']);
        }
        config(['adlara.context' => \App\Classes\Context::getContext()]);
        config(['adlara.request' => $request]);
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
