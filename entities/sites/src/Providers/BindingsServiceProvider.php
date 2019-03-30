<?php

namespace InetStudio\Reviews\Sites\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * @var  array
     */
    public $bindings = [
        'InetStudio\Reviews\Sites\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\Reviews\Sites\Events\Back\ModifyItemEvent',
        'InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\Reviews\Sites\Http\Controllers\Back\ResourceController',
        'InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\Reviews\Sites\Http\Controllers\Back\DataController',
        'InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\Reviews\Sites\Http\Controllers\Back\UtilityController',
        'InetStudio\Reviews\Sites\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\Reviews\Sites\Http\Requests\Back\SaveItemRequest',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\Reviews\Sites\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract' => 'InetStudio\Reviews\Sites\Models\SiteModel',
        'InetStudio\Reviews\Sites\Contracts\Services\Back\DataTableServiceContract' => 'InetStudio\Reviews\Sites\Services\Back\DataTableService',
        'InetStudio\Reviews\Sites\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\Reviews\Sites\Services\Back\ItemsService',
        'InetStudio\Reviews\Sites\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\Reviews\Sites\Services\Back\UtilityService',
        'InetStudio\Reviews\Sites\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\Reviews\Sites\Services\Front\ItemsService',
        'InetStudio\Reviews\Sites\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\Reviews\Sites\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\Reviews\Sites\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\Reviews\Sites\Transformers\Back\Utility\SuggestionTransformer',
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
