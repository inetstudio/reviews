<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Back\Moderate;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;

/**
 * Class ReadResponse.
 */
class ReadResponse implements ReadResponseContract, Responsable
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * ReadResponse constructor.
     *
     * @param bool $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при простановке флага прочитанности.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json([
            'success' => $this->result,
        ]);
    }
}
