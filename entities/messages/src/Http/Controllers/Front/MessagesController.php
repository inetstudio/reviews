<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Services\Front\MessagesServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Front\SendMessageRequestContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetMessagesResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\SendMessageResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front\MessagesControllerContract;

/**
 * Class MessagesController.
 */
class MessagesController extends Controller implements MessagesControllerContract
{
    /**
     * Отправка отзыва.
     *
     * @param MessagesServiceContract $messagesService
     * @param SendMessageRequestContract $request
     * @param string $type
     * @param string $id
     *
     * @return SendMessageResponseContract
     */
    public function sendMessage(MessagesServiceContract $messagesService,
                                SendMessageRequestContract $request,
                                string $type,
                                string $id): SendMessageResponseContract
    {
        $data = $request->only($messagesService->model->getFillable());

        $message = $messagesService->saveMessage($data, $type, $id);

        $result = ($message && isset($message->id));

        return app()->makeWith(SendMessageResponseContract::class, compact('result'));
    }

    /**
     * Получаем отзывы к материалу.
     *
     * @param MessagesServiceContract $messagesService
     * @param Request $request
     * @param string $type
     * @param string $id
     *
     * @return GetMessagesResponseContract
     */
    public function getMessages(MessagesServiceContract $messagesService,
                                Request $request,
                                string $type,
                                string $id): GetMessagesResponseContract
    {
        $page = ($request->filled('page')) ? $request->get('page') - 1 : 0;
        $limit = ($request->filled('limit')) ? $request->get('limit') : 3;

        $messages = $messagesService->getMessagesByTypeAndId($type, $id)->sortByDesc('datetime');

        return app()->makeWith(GetMessagesResponseContract::class, [
            'data' => [
                'messages' => [
                    'stop' => (($page + 1) * $limit >= $messages->count()),
                    'items' => $messages->slice($page * $limit, $limit),
                ],
            ]
        ]);
    }
}
