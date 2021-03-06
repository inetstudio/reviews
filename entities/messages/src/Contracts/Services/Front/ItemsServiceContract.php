<?php

namespace InetStudio\Reviews\Messages\Contracts\Services\Front;

use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract
{
    /**
     * Сохраняем отзыв.
     *
     * @param  array  $data
     * @param  string  $type
     * @param  int  $id
     *
     * @return MessageModelContract|null
     */
    public function saveMessage(
        array $data,
        string $type,
        int $id
    ): ?MessageModelContract;

    /**
     * Получаем отзывы по типу и id материала.
     *
     * @param  string  $type
     * @param  int  $id
     * @param  array  $params
     *
     * @return mixed
     */
    public function getItemsByTypeAndId(string $type, int $id, array $params = []);
}
