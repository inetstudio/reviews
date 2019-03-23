<?php

namespace InetStudio\Reviews\Sites\Contracts\Transformers\Back\Resource;

use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;

/**
 * Interface IndexTransformerContract.
 */
interface IndexTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param SiteModelContract $item
     *
     * @return array
     */
    public function transform(SiteModelContract $item): array;
}
