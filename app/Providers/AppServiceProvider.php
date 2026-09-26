<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use App\Observers\AffectationObserver;
use App\Observers\FormateurObserver;

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

        // Observers
        AffectationModel::observe(AffectationObserver::class);
        FormateurModel::observe(FormateurObserver::class);
    }
}