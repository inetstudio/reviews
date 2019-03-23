<?php

namespace InetStudio\Reviews\Sites\Contracts\Services\Back;

use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Сохраняем модель.
     *
     * @param array $data
     * @param int $id
     *
     * @return SiteModelContract
     */
    public function save(array $data, int $id): SiteModelContract;
}
