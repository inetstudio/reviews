<?php

namespace InetStudio\Reviews\Messages\Contracts\Services\Front;

use Illuminate\Support\Collection;
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
     *
     * @return Collection
     */
    public function getMessagesByTypeAndId(string $type, int $id): Collection;
}
