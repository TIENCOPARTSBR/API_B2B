<?php

namespace App\Providers;

use App\Interfaces\AdminConfigInterface;
use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\DirectDistributorInterface;
use App\Repositories\AdminConfigRepository;
use App\Repositories\AdminRepository;
use App\Repositories\DirectDistributorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AdminRepositoryInterface::class,
            AdminRepository::class
        );

        $this->app->bind(
            DirectDistributorInterface::class,
            DirectDistributorRepository::class
        );

        $this->app->bind(
            AdminConfigInterface::class,
            AdminConfigRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
