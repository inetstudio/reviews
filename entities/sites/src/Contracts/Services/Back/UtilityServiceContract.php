<?php

namespace InetStudio\Reviews\Sites\Contracts\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface UtilityServiceContract.
 */
interface UtilityServiceContract extends BaseServiceContract
{
    /**
     * Получаем подсказки.
     *
     * @param string $search
     *
     * @return Collection
     */
    public function getSuggestions(string $search): Collection;
}