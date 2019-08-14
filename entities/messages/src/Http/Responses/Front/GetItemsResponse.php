<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Front;

use InetStudio\AdminPanel\Base\Http\Responses\BaseResponse;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetItemsResponseContract;
use InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract as MessagesServiceContract;

/**
 * Class GetItemsResponse.
 */
class GetItemsResponse extends BaseResponse implements GetItemsResponseContract
{
    /**
     * @var MessagesServiceContract
     */
    protected $messagesService;

    /**
     * GetItemsResponse constructor.
     *
     * @param  MessagesServiceContract  $messagesService
     */
    public function __construct(
        MessagesServiceContract $messagesService
    ) {
        $this->messagesService = $messagesService;

        $this->render = true;
        $this->view = 'admin.module.reviews.messages::front.ajax.more';
    }

    /**
     * Prepare response data.
     *
     * @param $request
     *
     * @return array
     */
    protected function prepare($request): array
    {
        $type = $request->route('type');
        $id = $request->route('id');

        $page = ($request->filled('page')) ? $request->get('page') - 1 : 0;
        $limit = ($request->filled('limit')) ? $request->get('limit') : 3;

        $items = $this->messagesService->getItemsByTypeAndId($type, $id)->sortByDesc('datetime');

        return [
            'messages' => [
                'stop' => (($page + 1) * $limit >= $items->count()),
                'items' => $items->slice($page * $limit, $limit),
            ],
        ];
    }
}
