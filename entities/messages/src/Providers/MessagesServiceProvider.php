<?php

namespace InetStudio\Reviews\Messages\Providers;

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
        $this->registerObservers();
    }

    /**
     * Регистрация привязки в контейнере.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerBindings();
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
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateReviewsMessagesTables')) {
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
     * Регистрация наблюдателей.
     *
     * @return void
     */
    public function registerObservers(): void
    {
        $this->app->make('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract')::observe($this->app->make('InetStudio\Reviews\Messages\Contracts\Observers\MessageObserverContract'));
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    protected function registerBindings(): void
    {
        // Controllers
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesControllerContract', 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesController');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesDataControllerContract', 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesDataController');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesUtilityControllerContract', 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesUtilityController');

        // Events
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyMessageEventContract', 'InetStudio\Reviews\Messages\Events\Back\ModifyMessageEvent');

        // Models
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract', 'InetStudio\Reviews\Messages\Models\MessageModel');

        // Observers
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Observers\MessageObserverContract', 'InetStudio\Reviews\Messages\Observers\MessageObserver');

        // Repositories
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Repositories\MessagesRepositoryContract', 'InetStudio\Reviews\Messages\Repositories\MessagesRepository');

        // Requests
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveMessageRequestContract', 'InetStudio\Reviews\Messages\Http\Requests\Back\SaveMessageRequest');

        // Responses
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\DestroyResponseContract', 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\DestroyResponse');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\FormResponseContract', 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\FormResponse');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\IndexResponseContract', 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\IndexResponse');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\SaveResponseContract', 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\SaveResponse');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\ShowResponseContract', 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\ShowResponse');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', 'InetStudio\Reviews\Messages\Http\Responses\Back\Utility\SuggestionsResponse');

        // Services
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesDataTableServiceContract', 'InetStudio\Reviews\Messages\Services\Back\MessagesDataTableService');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesObserverServiceContract', 'InetStudio\Reviews\Messages\Services\Back\MessagesObserverService');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract', 'InetStudio\Reviews\Messages\Services\Back\MessagesService');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Services\Front\MessagesServiceContract', 'InetStudio\Reviews\Messages\Services\Front\MessagesService');

        // Transformers
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Transformers\Back\MessageTransformerContract', 'InetStudio\Reviews\Messages\Transformers\Back\MessageTransformer');
        $this->app->bind('InetStudio\Reviews\Messages\Contracts\Transformers\Back\SuggestionTransformerContract', 'InetStudio\Reviews\Messages\Transformers\Back\SuggestionTransformer');
    }
}
