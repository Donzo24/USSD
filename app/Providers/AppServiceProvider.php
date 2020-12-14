<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\{Methode, Categorie};
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);

        View::share('methodes', Methode::get());
        View::share('top_level_categories', Categorie::whereNull('id_parent')->inRandomOrder()->get());
        View::share('all_categories', Categorie::inRandomOrder()->get());

    }
}
