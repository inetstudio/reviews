<?php

namespace InetStudio\Reviews\Messages\Contracts\Transformers\Back\Utility;

use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;

/**
 * Interface SuggestionTransformerContract.
 */
interface SuggestionTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param MessageModelContract $item
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
