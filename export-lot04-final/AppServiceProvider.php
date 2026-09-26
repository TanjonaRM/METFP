<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use App\Observers\AffectationObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pagination Tailwind
        Paginator::useTailwind();

        // Observer pour création automatique des sessions
        AffectationModel::observe(AffectationObserver::class);
    }
}