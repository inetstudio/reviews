<?php

namespace InetStudio\Reviews\Sites\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Transformers\Back\SiteTransformerContract;

/**
 * Class SiteTransformer.
 */
class SiteTransformer extends TransformerAbstract implements SiteTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param SiteModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(SiteModelContract $item): array
    {
        return [
            'name' => $item->getAttribute('name'),
            'alias' => $item->getAttribute('alias'),
            'created_at' => (string) $item->getAttribute('created_at'),
            'updated_at' => (string) $item->getAttribute('updated_at'),
            'actions' => view('admin.module.reviews.sites::back.partials.datatables.actions', [
                'id' => $item->getAttribute('id'),
            ])->render(),
        ];
    }
}
