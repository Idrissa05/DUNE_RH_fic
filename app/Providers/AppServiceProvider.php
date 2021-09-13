<?php

namespace App\Providers;

use App\Http\View\Composers\ConfigComposer;
use App\Models\Agent;
use App\Observers\AgentObserver;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
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

        if(env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @param UrlGenerator $url
     * @return void
     */
    public function boot(UrlGenerator $url)
    {

        if(env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }

        if($this->app->environment() === 'local') {
            DB::listen(function(QueryExecuted $sql)
            {
                file_put_contents('php://stdout', "\e[34m{$sql->sql}\t\e[37m" . json_encode($sql->bindings) . "\t\e[32m{$sql->time}ms\e[0m\n");
            });
        }

        View::composer(['layouts.material', 'pdf.document'], ConfigComposer::class);

        Agent::observe(AgentObserver::class);
    }
}
