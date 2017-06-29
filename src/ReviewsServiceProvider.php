<?php

namespace InetStudio\Reviews;

use Illuminate\Support\ServiceProvider;

class ReviewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../public' => public_path(),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/../resources/views/admin', 'admin.module.reviews');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->mergeConfigFrom(
            __DIR__.'/../config/filesystems.php', 'filesystems.disks'
        );

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateReviewsTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_reviews_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_reviews_tables.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Spatie\MediaLibrary\MediaLibraryServiceProvider');
    }
}
