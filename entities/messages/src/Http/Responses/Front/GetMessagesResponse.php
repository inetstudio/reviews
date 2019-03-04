<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Front;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetMessagesResponseContract;

/**
 * Class GetMessagesResponse.
 */
class GetMessagesResponse implements GetMessagesResponseContract, Responsable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * GetMessagesResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при открытии списка объектов.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function toResponse($request): View
    {
        return view('admin.module.reviews.messages::front.ajax.more', $this->data);
    }
}
