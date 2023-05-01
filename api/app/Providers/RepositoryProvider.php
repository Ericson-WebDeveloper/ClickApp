<?php

namespace App\Providers;

use App\Interface\ClickInterface;
use App\Repository\ClickRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ClickInterface::class, ClickRepository::class);
    }
}
