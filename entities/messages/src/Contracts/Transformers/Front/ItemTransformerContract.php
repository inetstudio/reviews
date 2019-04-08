<?php

namespace InetStudio\Reviews\Messages\Contracts\Transformers\Front;

use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;

/**
 * Interface ItemTransformerContract.
 */
interface ItemTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param  MessageModelContract  $item
     *
     * @return array
     */
    public function transform(MessageModelContract $item): array;

    /**
     * Обработка коллекции объектов.
     *
     * @param $items
     *
     * @return FractalCollection
     */
    public function transformCollection($items): FractalCollection;
}
