<?php

namespace InetStudio\Reviews\Sites\Transformers\Back\Resource;

use Throwable;
use League\Fractal\TransformerAbstract;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Transformers\Back\Resource\IndexTransformerContract;

/**
 * Class IndexTransformer.
 */
class IndexTransformer extends TransformerAbstract implements IndexTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param  SiteModelContract  $item
     *
     * @return array
     *
     * @throws Throwable
     */
    public function transform(SiteModelContract $item): array
    {
        return [
            'name' => $item['name'],
            'alias' => $item['alias'],
            'created_at' => (string) $item['created_at'],
            'updated_at' => (string) $item['updated_at'],
            'actions' => view('admin.module.reviews.sites::back.partials.datatables.actions', [
                'id' => $item['id'],
            ])->render(),
        ];
    }
}
