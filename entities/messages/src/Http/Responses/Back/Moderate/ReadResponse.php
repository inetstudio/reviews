<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Back\Moderate;

use Illuminate\Http\Request;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;

/**
 * Class ReadResponse.
 */
class ReadResponse implements ReadResponseContract
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * ReadResponse constructor.
     *
     * @param  bool  $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при простановке флага прочитанности.
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
            ]
        );
    }
}
