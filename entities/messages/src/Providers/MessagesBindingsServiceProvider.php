<?php

namespace InetStudio\Reviews\Messages\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class MessagesBindingsServiceProvider.
 */
class MessagesBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyMessageEventContract' => 'InetStudio\Reviews\Messages\Events\Back\ModifyMessageEvent',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesDataControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesDataController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesUtilityControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesUtilityController',
        'InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveMessageRequestContract' => 'InetStudio\Reviews\Messages\Http\Requests\Back\SaveMessageRequest',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\DestroyResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\DestroyResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\FormResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\FormResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\IndexResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\IndexResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\SaveResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\SaveResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\ShowResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Messages\ShowResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract' => 'InetStudio\Reviews\Messages\Models\MessageModel',
        'InetStudio\Reviews\Messages\Contracts\Repositories\MessagesRepositoryContract' => 'InetStudio\Reviews\Messages\Repositories\MessagesRepository',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesDataTableServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\MessagesDataTableService',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\MessagesService',
        'InetStudio\Reviews\Messages\Contracts\Services\Front\MessagesServiceContract' => 'InetStudio\Reviews\Messages\Services\Front\MessagesService',
        'InetStudio\Reviews\Messages\Contracts\Transformers\Back\MessageTransformerContract' => 'InetStudio\Reviews\Messages\Transformers\Back\MessageTransformer',
        'InetStudio\Reviews\Messages\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\Reviews\Messages\Transformers\Back\SuggestionTransformer',
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
