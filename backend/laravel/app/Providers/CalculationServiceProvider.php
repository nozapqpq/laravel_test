<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// app\Components\Calculationを使えるようにする
use App\Components\Calculation;
// このサービスプロバイダをconfig\app.phpに登録する必要あり

class CalculationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('Calculation', Calculation::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
