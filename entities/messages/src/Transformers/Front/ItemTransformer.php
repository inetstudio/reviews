<?php

namespace InetStudio\Reviews\Messages\Transformers\Front;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Transformers\Front\ItemTransformerContract;

/**
 * Class ItemTransformer.
 */
class ItemTransformer extends TransformerAbstract implements ItemTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param MessageModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(MessageModelContract $item): array
    {
        $user = $item['user'];

        return [
            'id' => $item['id'],
            'user' => [
                'roles' => ($user) ? $user->roles->pluck('name')->toArray() : [],
                'name' => $item['name'],
            ],
            'datetime' => (string) $item['created_at'],
            'message' => $item['message'],
            'rating' => $item['rating'],
        ];
    }

    /**
     * Обработка коллекции объектов.
     *
     * @param $items
     *
     * @return FractalCollection
     */
    public function transformCollection($items): FractalCollection
    {
        return new FractalCollection($items, $this);
    }
}
