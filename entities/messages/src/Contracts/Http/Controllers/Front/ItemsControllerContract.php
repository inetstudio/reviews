<?php

namespace InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front;

use Illuminate\Http\Request;
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
     * @param ItemsServiceContract $messagesService
     * @param SendItemRequestContract $request
     * @param string $type
     * @param int $id
     *
     * @return SendItemResponseContract
     */
    public function sendMessage(ItemsServiceContract $messagesService,
                                SendItemRequestContract $request,
                                string $type,
                                int $id): SendItemResponseContract;

    /**
     * Получаем отзывы к материалу.
     *
     * @param ItemsServiceContract $messagesService
     * @param Request $request
     * @param string $type
     * @param int $id
     *
     * @return GetItemsResponseContract
     */
    public function getMessages(ItemsServiceContract $messagesService,
                                Request $request,
                                string $type,
                                int $id): GetItemsResponseContract;
}
