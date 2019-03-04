<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Front;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\SendMessageResponseContract;

/**
 * Class SendMessageResponse.
 */
class SendMessageResponse implements SendMessageResponseContract, Responsable
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * SendMessageResponse constructor.
     *
     * @param bool $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при удалении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'success' => $this->result,
            'message' => ($this->result)
                ? trans('reviews::messages.send_success')
                : trans('reviews::messages.send_fail'),
        ]);
    }
}
