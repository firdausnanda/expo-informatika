<?php

namespace App\Providers;

use App\Models\Matakuliah;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        $matakuliah = Matakuliah::take(10)->get();

        View::composer('layouts.landing.footer', function ($view) use ($matakuliah) {
            $view->with('matakuliah', $matakuliah);
        });
    }
}
