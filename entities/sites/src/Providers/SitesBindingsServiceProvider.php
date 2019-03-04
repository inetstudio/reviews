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
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract' => 'InetStudio\Reviews\Sites\Models\SiteModel',
        'InetStudio\Reviews\Sites\Contracts\Services\Back\SitesDataTableServiceContract' => 'InetStudio\Reviews\Sites\Services\Back\SitesDataTableService',
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
