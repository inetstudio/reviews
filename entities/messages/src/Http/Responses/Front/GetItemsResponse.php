<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Front;

use Illuminate\Http\Request;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetItemsResponseContract;

/**
 * Class GetItemsResponse.
 */
class GetItemsResponse implements GetItemsResponseContract
{
    /**
     * @var array
     */
    protected $data;

    /**
     * GetItemsResponse constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при открытии списка объектов.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('admin.module.reviews.messages::front.ajax.more', $this->data);
    }
}
