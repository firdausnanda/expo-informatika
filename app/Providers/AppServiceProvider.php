<?php

namespace App\Providers;

use App\Models\Kategori;
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
        $matakuliah = Matakuliah::take(5)->get();
        $kategori = Kategori::orderByRaw('RAND()')->take(15)->get();

        View::composer('layouts.landing.footer', function ($view) use ($matakuliah, $kategori) {
            $view->with('matakuliah', $matakuliah);
            $view->with('kategori', $kategori);
        });
    }
}
