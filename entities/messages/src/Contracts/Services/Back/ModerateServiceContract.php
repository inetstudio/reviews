<?php

namespace InetStudio\Reviews\Messages\Contracts\Services\Back;

/**
 * Interface ModerateServiceContract.
 */
interface ModerateServiceContract
{
    /**
     * Изменение активности.
     *
     * @param mixed $ids
     * @param array $params
     *
     * @return bool
     */
    public function updateActivity($ids, array $params = []): bool;

    /**
     * Пометка "прочитано".
     *
     * @param $ids
     * @param array $params
     *
     * @return bool
     */
    public function updateRead($ids, array $params = []): bool;
}
