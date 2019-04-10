<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Front;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Front\SendItemRequestContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetItemsResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\SendItemResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front\ItemsControllerContract;

/**
 * Class ItemsController.
 */
class ItemsController extends Controller implements ItemsControllerContract
{
    /**
     * Отправка отзыва.
     *
     * @param  ItemsServiceContract  $messagesService
     * @param  SendItemRequestContract  $request
     * @param  string  $type
     * @param  int  $id
     *
     * @return SendItemResponseContract
     *
     * @throws BindingResolutionException
     */
    public function sendMessage(
        ItemsServiceContract $messagesService,
        SendItemRequestContract $request,
        string $type,
        int $id
    ): SendItemResponseContract {
        $data = $request->input();
        $data = ($data) ? (array) $data : [];
        $data['files'] = $request->allFiles();

        $item = $messagesService->saveMessage($data, $type, $id);

        $result = ($item && isset($item['id']));

        return $this->app->make(SendItemResponseContract::class, compact('result'));
    }

    /**
     * Получаем отзывы к материалу.
     *
     * @param  ItemsServiceContract  $messagesService
     * @param  Request  $request
     * @param  string  $type
     * @param  int  $id
     *
     * @return GetItemsResponseContract
     *
     * @throws BindingResolutionException
     */
    public function getMessages(
        ItemsServiceContract $messagesService,
        Request $request,
        string $type,
        int $id
    ): GetItemsResponseContract {
        $page = ($request->filled('page')) ? $request->get('page') - 1 : 0;
        $limit = ($request->filled('limit')) ? $request->get('limit') : 3;

        $items = $messagesService->getMessagesByTypeAndId($type, $id)->sortByDesc('datetime');

        return $this->app->make(
            GetItemsResponseContract::class, [
            'data' => [
                'messages' => [
                    'stop' => (($page + 1) * $limit >= $items->count()),
                    'items' => $items->slice($page * $limit, $limit),
                ],
            ],
        ]
        );
    }
}
