<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\News\NewsRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
