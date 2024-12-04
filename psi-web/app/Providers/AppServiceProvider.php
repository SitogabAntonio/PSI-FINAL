<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\User;

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
        Paginator::useBootstrapFive();

        View::composer('modules.client.*', function ($view) {
            $domain = request()->segment(1);
            $gereja = User::where('domain', $domain)
                ->with(['sejarah', 'visi', 'misi'])
                ->first();

            $view->with('gereja', $gereja);
        });

        View::composer('session.*', function ($view) {
            $domain = request()->segment(1);
            $gereja = User::where('domain', $domain)
                ->with(['sejarah', 'visi', 'misi'])
                ->first();

            $view->with('gereja', $gereja);
        });
    }
}
