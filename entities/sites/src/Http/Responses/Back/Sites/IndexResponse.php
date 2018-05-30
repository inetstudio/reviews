<?php

namespace InetStudio\Reviews\Sites\Http\Responses\Back\Sites;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\IndexResponseContract;

/**
 * Class IndexResponse.
 */
class IndexResponse implements IndexResponseContract, Responsable
{
    /**
     * @var array
     */
    private $data;

    /**
     * IndexResponse constructor.
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
        return view('admin.module.reviews.sites::back.pages.index', $this->data);
    }
}
