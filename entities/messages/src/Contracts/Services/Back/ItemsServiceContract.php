<?php

namespace InetStudio\Reviews\Messages\Contracts\Services\Back;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Получаем объект по id (для отображения).
     *
     * @param int $id
     * @param array $params
     *
     * @return MessageModelContract|null
     */
    public function getItemByIdForDisplay(int $id = 0, array $params = []): ?MessageModelContract;

    /**
     * Сохраняем модель.
     *
     * @param array $data
     * @param int $id
     *
     * @return MessageModelContract
     */
    public function save(array $data, int $id): MessageModelContract;

    /**
     * Получаем количество непрочитанных отзывов.
     *
     * @return int
     */
    public function getUnreadMessagesCount(): int;
}
