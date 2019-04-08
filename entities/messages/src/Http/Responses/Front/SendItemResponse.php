<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Front;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\SendItemResponseContract;

/**
 * Class SendItemResponse.
 */
class SendItemResponse implements SendItemResponseContract, Responsable
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * SendItemResponse constructor.
     *
     * @param  bool  $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при удалении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json(
            [
                'success' => $this->result,
                'message' => ($this->result)
                    ? trans('reviews::messages.send_success')
                    : trans('reviews::messages.send_fail'),
            ]
        );
    }
}
