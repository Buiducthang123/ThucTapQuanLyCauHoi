<?php

namespace App\Providers;

use App\Repositories\Question\QuestionRepository;
use App\Repositories\Question\QuestionRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            QuestionRepositoryInterface::class,
            QuestionRepository::class
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
