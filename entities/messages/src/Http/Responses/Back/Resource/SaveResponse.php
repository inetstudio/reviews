<?php

namespace InetStudio\Reviews\Messages\Http\Responses\Back\Resource;

use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var MessageModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param MessageModelContract $item
     */
    public function __construct(MessageModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $this->item = $this->item->fresh();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $this->item->id,
                'title' => ($this->item->title) ? $this->item->title : Str::limit($this->item->message, '100', '...'),
            ], 200);
        } else {
            return response()->redirectToRoute('back.reviews.messages.edit', [
                $this->item->id,
            ]);
        }
    }
}