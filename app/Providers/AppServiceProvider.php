<?php

namespace sistemaTurbo\Providers;

use Illuminate\Support\ServiceProvider;
//mandar a llamar a schema
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //esto sirve para quitar el error en las migraciones por la longitud att Nilmar
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
