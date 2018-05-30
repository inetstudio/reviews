<?php

namespace InetStudio\Reviews\Sites\Transformers\Back;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Transformers\Back\SuggestionTransformerContract;

/**
 * Class SuggestionTransformer.
 */
class SuggestionTransformer extends TransformerAbstract implements SuggestionTransformerContract
{
    /**
     * @var string
     */
    private $type;

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
     * @param SiteModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(SiteModelContract $item): array
    {
        if ($this->type && $this->type == 'autocomplete') {

            return [
                'value' => $item->getAttribute('name'),
                'data' => [
                    'id' => $item->getAttribute('id'),
                    'name' => $item->getAttribute('name'),
                ],
            ];
        } else {
            return [
                'id' => $item->getAttribute('id'),
                'name' => $item->getAttribute('name'),
            ];
        }
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
