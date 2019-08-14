<?php

namespace InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front;

use InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Front\SendItemRequestContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetItemsResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\SendItemResponseContract;

/**
 * Interface ItemsControllerContract.
 */
interface ItemsControllerContract
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
     */
    public function sendMessage(
        ItemsServiceContract $messagesService,
        SendItemRequestContract $request,
        string $type,
        int $id
    ): SendItemResponseContract;

    /**
     * Получаем отзывы к материалу.
     *
     * @param  GetItemsResponseContract  $response
     *
     * @return GetItemsResponseContract
     */
    public function getItems(GetItemsResponseContract $response): GetItemsResponseContract;
}
