<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Back\Moderate;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract;

/**
 * Class ActivityResponse.
 */
class ActivityResponse implements ActivityResponseContract, Responsable
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * ActivityResponse constructor.
     *
     * @param bool $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при изменении активности.
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
