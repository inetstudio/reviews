<?php

namespace InetStudio\Reviews\Messages\Transformers\Back;

use League\Fractal\TransformerAbstract;
use Illuminate\Support\Str;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Transformers\Back\MessageTransformerContract;

/**
 * Class MessageTransformer.
 */
class MessageTransformer extends TransformerAbstract implements MessageTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param MessageModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(MessageModelContract $item): array
    {
        return [
            'user_name' => $item->user_name,
            'title' => $item->title,
            'message' => Str::words(strip_tags($item->message), 200, '...'),
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
            'actions' => view('admin.module.reviews.messages::back.partials.datatables.actions', [
                'id' => $item->getAttribute('id'),
            ])->render(),
        ];
    }
}
