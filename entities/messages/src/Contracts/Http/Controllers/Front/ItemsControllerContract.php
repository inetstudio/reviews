<?php

namespace InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front;

use Illuminate\Http\Request;
use InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract;
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
     * @param ItemsServiceContract $messagesService
     * @param Request $request
     * @param string $type
     * @param string $id
     *
     * @return SendItemResponseContract
     */
    public function sendMessage(ItemsServiceContract $messagesService,
                                Request $request,
                                string $type,
                                string $id): SendItemResponseContract;

    /**
     * Получаем отзывы к материалу.
     *
     * @param ItemsServiceContract $messagesService
     * @param Request $request
     * @param string $type
     * @param string $id
     *
     * @return GetItemsResponseContract
     */
    public function getMessages(ItemsServiceContract $messagesService,
                                Request $request,
                                string $type,
                                string $id): GetItemsResponseContract;
}
