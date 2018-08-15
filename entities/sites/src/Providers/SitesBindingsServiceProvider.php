<?php

namespace InetStudio\Reviews\Sites\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class SitesBindingsServiceProvider.
 */
class SitesBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\Reviews\Sites\Contracts\Events\Back\ModifySiteEventContract' => 'InetStudio\Reviews\Sites\Events\Back\ModifySiteEvent',
        'InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesControllerContract' => 'InetStudio\Reviews\Sites\Http\Controllers\Back\SitesController',
        'InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesDataControllerContract' => 'InetStudio\Reviews\Sites\Http\Controllers\Back\SitesDataController',
        'InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesUtilityControllerContract' => 'InetStudio\Reviews\Sites\Http\Controllers\Back\SitesUtilityController',
        'InetStudio\Reviews\Sites\Contracts\Http\Requests\Back\SaveSiteRequestContract' => 'InetStudio\Reviews\Sites\Http\Requests\Back\SaveSiteRequest',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\DestroyResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Sites\DestroyResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\FormResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Sites\FormResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\IndexResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Sites\IndexResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\SaveResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Sites\SaveResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract' => 'InetStudio\Reviews\Sites\Models\SiteModel',
        'InetStudio\Reviews\Sites\Contracts\Observers\SiteObserverContract' => 'InetStudio\Reviews\Sites\Observers\SiteObserver',
        'InetStudio\Reviews\Sites\Contracts\Repositories\SitesRepositoryContract' => 'InetStudio\Reviews\Sites\Repositories\SitesRepository',
        'InetStudio\Reviews\Sites\Contracts\Services\Back\SitesDataTableServiceContract' => 'InetStudio\Reviews\Sites\Services\Back\SitesDataTableService',
        'InetStudio\Reviews\Sites\Contracts\Services\Back\SitesObserverServiceContract' => 'InetStudio\Reviews\Sites\Services\Back\SitesObserverService',
        'InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract' => 'InetStudio\Reviews\Sites\Services\Back\SitesService',
        'InetStudio\Reviews\Sites\Contracts\Services\Front\SitesServiceContract' => 'InetStudio\Reviews\Sites\Services\Front\SitesService',
        'InetStudio\Reviews\Sites\Contracts\Transformers\Back\SiteTransformerContract' => 'InetStudio\Reviews\Sites\Transformers\Back\SiteTransformer',
        'InetStudio\Reviews\Sites\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\Reviews\Sites\Transformers\Back\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}