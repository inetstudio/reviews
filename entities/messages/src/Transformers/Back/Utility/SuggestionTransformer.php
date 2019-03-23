<?php

namespace InetStudio\Reviews\Messages\Transformers\Back\Utility;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

/**
 * Class SuggestionTransformer.
 */
class SuggestionTransformer extends TransformerAbstract implements SuggestionTransformerContract
{
    /**
     * @var string
     */
    protected $type;

    /**
     * SuggestionTransformer constructor.
     *
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Подготовка данных для отображения в выпадающих списках.
     *
     * @param MessageModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(MessageModelContract $item): array
    {
        return ($this->type == 'autocomplete') ? [
            'value' => $item['title'],
            'data' => [
                'id' => $item['id'],
                'title' => $item['title'],
                'user' => $item['user_name'],
            ],
        ] : [
            'id' => $item['id'],
            'name' => $item['title'],
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
