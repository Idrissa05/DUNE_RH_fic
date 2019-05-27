<?php

namespace App\Providers;

use App\Http\View\Composers\ConfigComposer;
use App\Models\Agent;
use App\Observers\AgentObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer('*', ConfigComposer::class);

        Agent::observe(AgentObserver::class);
    }
}
