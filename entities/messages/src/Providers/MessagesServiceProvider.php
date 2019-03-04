<?php

namespace InetStudio\Reviews\Messages\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class MessagesServiceProvider.
 */
class MessagesServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerTranslations();
        $this->registerEvents();
    }

    /**
     * Регистрация команд.
     *
     * @return void
     */
    protected function registerConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                'InetStudio\Reviews\Messages\Console\Commands\SetupCommand',
            ]);
        }
    }

    /**
     * Регистрация ресурсов.
     *
     * @return void
     */
    protected function registerPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../config/reviews_messages.php' => config_path('reviews_messages.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            if (! Schema::hasTable('reviews_messages')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_reviews_messages_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_reviews_messages_tables.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Регистрация путей.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     *
     * @return void
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.reviews.messages');
    }

    /**
     * Регистрация переводов.
     *
     * @return void
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'reviews');
    }

    /**
     * Регистрация событий.
     *
     * @return void
     */
    protected function registerEvents(): void
    {
        Event::listen('InetStudio\ACL\Activations\Contracts\Events\Front\ActivatedEventContract', 'InetStudio\Reviews\Messages\Contracts\Listeners\Front\AttachUserToReviewsListenerContract');
        Event::listen('InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract', 'InetStudio\Reviews\Messages\Contracts\Listeners\Front\AttachUserToReviewsListenerContract');
    }
}
