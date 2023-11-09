<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\DepInterface;
use App\Reposatries\DepRepo;


class RepoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DepInterface::class , DepRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
