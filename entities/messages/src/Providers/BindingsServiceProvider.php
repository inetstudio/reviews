<?php

namespace InetStudio\Reviews\Messages\Providers;

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
        'InetStudio\Reviews\Messages\Contracts\Mail\NewItemMailContract' => 'InetStudio\Reviews\Messages\Mail\NewItemMail',
        'InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract' => 'InetStudio\Reviews\Messages\Models\MessageModel',
        'InetStudio\Reviews\Messages\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\Reviews\Messages\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\Reviews\Messages\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\Reviews\Messages\Transformers\Back\Utility\SuggestionTransformer',
        'InetStudio\Reviews\Messages\Contracts\Transformers\Front\ItemTransformerContract' => 'InetStudio\Reviews\Messages\Transformers\Front\ItemTransformer',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Moderate\DestroyResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ReadResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Moderate\ReadResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Moderate\ActivityResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\SendItemResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Front\SendItemResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetItemsResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Front\GetItemsResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\Reviews\Messages\Http\Requests\Back\SaveItemRequest',
        'InetStudio\Reviews\Messages\Contracts\Http\Requests\Front\SendItemRequestContract' => 'InetStudio\Reviews\Messages\Http\Requests\Front\SendItemRequest',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\ResourceController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\DataController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\ModerateControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\ModerateController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\UtilityController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front\ItemsControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Front\ItemsController',
        'InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\Reviews\Messages\Events\Back\ModifyItemEvent',
        'InetStudio\Reviews\Messages\Contracts\Events\Front\SendItemEventContract' => 'InetStudio\Reviews\Messages\Events\Front\SendItemEvent',
        'InetStudio\Reviews\Messages\Contracts\Listeners\SendEmailToAdminListenerContract' => 'InetStudio\Reviews\Messages\Listeners\SendEmailToAdminListener',
        'InetStudio\Reviews\Messages\Contracts\Listeners\Front\AttachUserToReviewsListenerContract' => 'InetStudio\Reviews\Messages\Listeners\Front\AttachUserToReviewsListener',
        'InetStudio\Reviews\Messages\Contracts\Notifications\NewItemQueueableNotificationContract' => 'InetStudio\Reviews\Messages\Notifications\NewItemQueueableNotification',
        'InetStudio\Reviews\Messages\Contracts\Notifications\NewItemNotificationContract' => 'InetStudio\Reviews\Messages\Notifications\NewItemNotification',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\ItemsService',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\DataTableServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\DataTableService',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\ModerateServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\ModerateService',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\UtilityService',
        'InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\Reviews\Messages\Services\Front\ItemsService',
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
