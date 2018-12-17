<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Menu;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('layouts.partials.nav', NavigationComposer::class);
    }

    public function register()
    {
        //
    }
}