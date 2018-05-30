<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Back\Messages;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\ShowResponseContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract, Responsable
{
    /**
     * @var MessageModelContract
     */
    private $item;

    /**
     * ShowResponse constructor.
     *
     * @param MessageModelContract $item
     */
    public function __construct(MessageModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при получении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json($this->item);
    }
}
