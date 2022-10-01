<?php

namespace App\Providers;

use App\Http\Containers\MovieContainer\Contracts\ActorQueryInterface;
use App\Http\Containers\MovieContainer\Contracts\ActorRepositoryInterface;
use App\Http\Containers\MovieContainer\Queries\MovieQueryBuilder;
use App\Http\Containers\MovieContainer\Repositories\MovieRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            ActorQueryInterface::class,
            MovieQueryBuilder::class,
        );

        $this->app->bind(
            ActorRepositoryInterface::class,
            MovieRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
