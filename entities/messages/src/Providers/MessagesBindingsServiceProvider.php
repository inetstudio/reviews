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
        'InetStudio\Reviews\Messages\Contracts\Mail\NewMessageMailContract' => 'InetStudio\Reviews\Messages\Mail\NewMessageMail',
        'InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract' => 'InetStudio\Reviews\Messages\Models\MessageModel',
        'InetStudio\Reviews\Messages\Contracts\Transformers\Back\MessageTransformerContract' => 'InetStudio\Reviews\Messages\Transformers\Back\MessageTransformer',
        'InetStudio\Reviews\Messages\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\Reviews\Messages\Transformers\Back\SuggestionTransformer',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Moderate\DestroyResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ReadResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Moderate\ReadResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Moderate\ActivityResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\SendMessageResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Front\SendMessageResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetMessagesResponseContract' => 'InetStudio\Reviews\Messages\Http\Responses\Front\GetMessagesResponse',
        'InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveMessageRequestContract' => 'InetStudio\Reviews\Messages\Http\Requests\Back\SaveMessageRequest',
        'InetStudio\Reviews\Messages\Contracts\Http\Requests\Front\SendMessageRequestContract' => 'InetStudio\Reviews\Messages\Http\Requests\Front\SendMessageRequest',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesDataControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesDataController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesModerateControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesModerateController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesUtilityControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Back\MessagesUtilityController',
        'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front\MessagesControllerContract' => 'InetStudio\Reviews\Messages\Http\Controllers\Front\MessagesController',
        'InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyMessageEventContract' => 'InetStudio\Reviews\Messages\Events\Back\ModifyMessageEvent',
        'InetStudio\Reviews\Messages\Contracts\Events\Front\SendMessageEventContract' => 'InetStudio\Reviews\Messages\Events\Front\SendMessageEvent',
        'InetStudio\Reviews\Messages\Contracts\Listeners\SendEmailToAdminListenerContract' => 'InetStudio\Reviews\Messages\Listeners\SendEmailToAdminListener',
        'InetStudio\Reviews\Messages\Contracts\Listeners\Front\AttachUserToReviewsListenerContract' => 'InetStudio\Reviews\Messages\Listeners\Front\AttachUserToReviewsListener',
        'InetStudio\Reviews\Messages\Contracts\Notifications\NewMessageQueueableNotificationContract' => 'InetStudio\Reviews\Messages\Notifications\NewMessageQueueableNotification',
        'InetStudio\Reviews\Messages\Contracts\Notifications\NewMessageNotificationContract' => 'InetStudio\Reviews\Messages\Notifications\NewMessageNotification',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\MessagesService',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesDataTableServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\MessagesDataTableService',
        'InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesModerateServiceContract' => 'InetStudio\Reviews\Messages\Services\Back\MessagesModerateService',
        'InetStudio\Reviews\Messages\Contracts\Services\Front\MessagesServiceContract' => 'InetStudio\Reviews\Messages\Services\Front\MessagesService',
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
