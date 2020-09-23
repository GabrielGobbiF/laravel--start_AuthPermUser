<?php

namespace App\Providers;

use App\Modules\Painel\Plans\Models\Plan;
use App\Modules\Painel\Plans\Observers\PlanObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.s
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
        Plan::observe(PlanObserver::class);
        Blade::component('components.alert', 'alert');
    }
}
