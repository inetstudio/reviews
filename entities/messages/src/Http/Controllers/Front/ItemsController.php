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
     * @param  GetItemsResponseContract  $response
     *
     * @return GetItemsResponseContract
     */
    public function getItems(GetItemsResponseContract $response): GetItemsResponseContract
    {
        return $response;
    }
}
