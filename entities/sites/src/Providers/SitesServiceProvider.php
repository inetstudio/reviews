<?php

namespace InetStudio\Reviews\Sites\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class SitesServiceProvider.
 */
class SitesServiceProvider extends ServiceProvider
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
                'InetStudio\Reviews\Sites\Console\Commands\SetupCommand',
                'InetStudio\Reviews\Sites\Console\Commands\CreateFoldersCommand',
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
            __DIR__.'/../../config/reviews_sites.php' => config_path('reviews_sites.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../../config/filesystems.php', 'filesystems.disks'
        );

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateReviewsSitesTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_reviews_sites_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_reviews_sites_tables.php'),
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.reviews.sites');
    }

    /**
     * Регистрация наблюдателей.
     *
     * @return void
     */
    public function registerObservers(): void
    {
        $this->app->make('InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract')::observe($this->app->make('InetStudio\Reviews\Sites\Contracts\Observers\SiteObserverContract'));
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    protected function registerBindings(): void
    {
        // Controllers
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesControllerContract', 'InetStudio\Reviews\Sites\Http\Controllers\Back\SitesController');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesDataControllerContract', 'InetStudio\Reviews\Sites\Http\Controllers\Back\SitesDataController');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesUtilityControllerContract', 'InetStudio\Reviews\Sites\Http\Controllers\Back\SitesUtilityController');

        // Events
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Events\Back\ModifySiteEventContract', 'InetStudio\Reviews\Sites\Events\Back\ModifySiteEvent');

        // Models
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract', 'InetStudio\Reviews\Sites\Models\SiteModel');

        // Observers
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Observers\SiteObserverContract', 'InetStudio\Reviews\Sites\Observers\SiteObserver');

        // Repositories
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Repositories\SitesRepositoryContract', 'InetStudio\Reviews\Sites\Repositories\SitesRepository');

        // Requests
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Requests\Back\SaveSiteRequestContract', 'InetStudio\Reviews\Sites\Http\Requests\Back\SaveSiteRequest');

        // Responses
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\DestroyResponseContract', 'InetStudio\Reviews\Sites\Http\Responses\Back\Sites\DestroyResponse');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\FormResponseContract', 'InetStudio\Reviews\Sites\Http\Responses\Back\Sites\FormResponse');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\IndexResponseContract', 'InetStudio\Reviews\Sites\Http\Responses\Back\Sites\IndexResponse');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\SaveResponseContract', 'InetStudio\Reviews\Sites\Http\Responses\Back\Sites\SaveResponse');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', 'InetStudio\Reviews\Sites\Http\Responses\Back\Utility\SuggestionsResponse');

        // Services
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Services\Back\SitesDataTableServiceContract', 'InetStudio\Reviews\Sites\Services\Back\SitesDataTableService');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Services\Back\SitesObserverServiceContract', 'InetStudio\Reviews\Sites\Services\Back\SitesObserverService');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract', 'InetStudio\Reviews\Sites\Services\Back\SitesService');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Services\Front\SitesServiceContract', 'InetStudio\Reviews\Sites\Services\Front\SitesService');

        // Transformers
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Transformers\Back\SiteTransformerContract', 'InetStudio\Reviews\Sites\Transformers\Back\SiteTransformer');
        $this->app->bind('InetStudio\Reviews\Sites\Contracts\Transformers\Back\SuggestionTransformerContract', 'InetStudio\Reviews\Sites\Transformers\Back\SuggestionTransformer');
    }
}
