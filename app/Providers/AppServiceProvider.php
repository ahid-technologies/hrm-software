<?php

namespace App\Providers;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
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
        if (app()->isLocal()) {
            // Prevent lazy loading
            Model::preventLazyLoading();

            // Prevent silently discarding unfillable attributes
            Model::preventSilentlyDiscardingAttributes();

            // Prevent accessing missing attributes
            Model::preventAccessingMissingAttributes();
        }
    }
}
