<?php

namespace InetStudio\Reviews\Sites\Http\Responses\Back\Resource;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var SiteModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param SiteModelContract $item
     */
    public function __construct(SiteModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->redirectToRoute('back.reviews.sites.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
