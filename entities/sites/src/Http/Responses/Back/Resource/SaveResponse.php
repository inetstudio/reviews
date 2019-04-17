<?php

namespace InetStudio\Reviews\Sites\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract
{
    /**
     * @var SiteModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param  SiteModelContract  $item
     */
    public function __construct(SiteModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $item = $this->item->fresh();

        return response()->redirectToRoute(
            'back.reviews.sites.edit', [
            $item['id'],
        ]
        );
    }
}
