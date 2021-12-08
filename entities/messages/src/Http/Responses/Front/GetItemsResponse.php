<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Front;

use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetItemsResponseContract;
use InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract as MessagesServiceContract;

class GetItemsResponse implements GetItemsResponseContract
{
    public function __construct(
        protected MessagesServiceContract $messagesService
    ) {}

    public function toResponse($request)
    {
        $type = $request->route('type');
        $id = $request->route('id');

        $page = ($request->filled('page')) ? $request->get('page') - 1 : 0;
        $limit = ($request->filled('limit')) ? $request->get('limit') : 3;

        $items = $this->messagesService->getItemsByTypeAndId($type, $id)->sortByDesc('datetime');

        return view(
            'admin.module.reviews.messages::front.ajax.more',
            [
                'messages' => [
                    'stop' => (($page + 1) * $limit >= $items->count()),
                    'items' => $items->slice($page * $limit, $limit),
                ],
            ]
        )->render();
    }
}
