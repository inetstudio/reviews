<?php

namespace InetStudio\Reviews\Messages\Transformers\Back;

use League\Fractal\TransformerAbstract;
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
            'checkbox' => view('admin.module.reviews.messages::back.partials.datatables.checkbox', [
                'id' => $item->id,
            ])->render(),
            'id' => (int) $item->id,
            'read' => view('admin.module.reviews.messages::back.partials.datatables.read', [
                'is_read' => $item->is_read,
            ])->render(),
            'active' => view('admin.module.reviews.messages::back.partials.datatables.active', [
                'id' => $item->id,
                'is_active' => $item->is_active,
            ])->render(),
            'name' => $item->name,
            'email' => $item->email,
            'title' => $item->title,
            'message' => $item->message,
            'created_at' => (string) $item->created_at,
            'material' => view('admin.module.reviews.messages::back.partials.datatables.material', [
                'item' => $item->commentable,
            ])->render(),
            'actions' => view('admin.module.reviews.messages::back.partials.datatables.actions', [
                'id' => $item->getAttribute('id'),
            ])->render(),
        ];
    }
}
