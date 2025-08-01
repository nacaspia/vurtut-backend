<?php

namespace App\Providers;

use App\View\Composer\CompanyAccountComposer;
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
        view()->composer(['site.company.layouts.app','site.company.home'], CompanyAccountComposer::class);

    }
}
