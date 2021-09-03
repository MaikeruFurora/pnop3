<?php

namespace App\Providers;

use App\Models\SchoolYear;
use Illuminate\Support\Facades\Config;
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
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $aydb = SchoolYear::where('status', 1)->first();
        Config::set('activeAY', $aydb);
        View::share('activeAY', $aydb);
    }
}
