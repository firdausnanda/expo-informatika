<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\Kategori;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        // if (config('app.env') === 'local') {
        //     URL::forceScheme('https');
        // }

        if (Schema::hasTable('m_matakuliah') && Schema::hasTable('m_kategori') && Schema::hasTable('contact_us')) {
            $matakuliah = Matakuliah::withCount('projects')->orderBy('projects_count', 'desc')->take(5)->get();
            $kategori = Kategori::orderByRaw('RAND()')->take(15)->get();

            $contactUs = ContactUs::doesnthave('views')->orderBy('created_at', 'desc')->take(5)->get();
            $contactUsCount = $contactUs->count();

            View::composer('layouts.landing.footer', function ($view) use ($matakuliah, $kategori, $contactUs) {
                $view->with('matakuliah', $matakuliah);
                $view->with('kategori', $kategori);
            });

            View::composer('layouts.admin.header', function ($view) use ($contactUs, $contactUsCount) {
                $view->with('contactUs', $contactUs);
                $view->with('contactUsCount', $contactUsCount);
            });
        }
    }
}
