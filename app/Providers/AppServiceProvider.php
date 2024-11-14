<?php

namespace App\Providers;

use App\Services\ErpServiceInterface;
use App\Services\NoErpService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
		$this->app->bind(ErpServiceInterface::class, NoErpService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
