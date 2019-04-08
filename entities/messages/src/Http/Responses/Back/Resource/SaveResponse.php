<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Back\Resource;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var MessageModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param  MessageModelContract  $item
     */
    public function __construct(MessageModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $item = $this->item->fresh();

        if ($request->ajax()) {
            return response()->json(
                [
                    'success' => true,
                    'id' => $item['id'],
                    'title' => ($item['title']) ? $item['title'] : Str::limit($item['message'], '100', '...'),
                ], 200
            );
        } else {
            return response()->redirectToRoute(
                'back.reviews.messages.edit', [
                $item['id'],
            ]
            );
        }
    }
}
