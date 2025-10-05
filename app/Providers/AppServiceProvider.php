<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // No repository registration needed anymore
    }

    public function boot(): void
    {
        //
    }
}
