<?php

namespace App\Providers;

use App\Models\About;
use App\Models\CompanyPolicy;
use App\Models\CompanyProfile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->share('content', CompanyProfile::first());
        view()->share('privacy', About::first());
        view()->share('policy', CompanyPolicy::first());
        
    }
}
