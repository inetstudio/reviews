<?php

namespace InetStudio\Reviews\Messages\Services\Back;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Services\Back\ModerateServiceContract;

/**
 * Class ModerateService.
 */
class ModerateService extends BaseService implements ModerateServiceContract
{
    /**
     * ModerateService constructor.
     *
     * @param MessageModelContract $model
     */
    public function __construct(MessageModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Изменение активности.
     *
     * @param mixed $ids
     * @param array $params
     *
     * @return bool
     */
    public function updateActivity($ids, array $params = []): bool
    {
        $items = $this->getItemById($ids, $params);

        foreach ($items as $item) {
            $item->update([
                'is_active' => ! $item->is_active,
                'is_read' => 1,
            ]);

            event(app()->make(
                'InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            ));
        }

        return true;
    }

    /**
     * Пометка "прочитано".
     *
     * @param $ids
     * @param array $params
     *
     * @return bool
     */
    public function updateRead($ids, array $params = []): bool
    {
        $items = $this->getItemById($ids, $params);

        foreach ($items as $item) {
            $item->update([
                'is_read' => 1,
            ]);

            event(app()->make(
                'InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            ));
        }

        return true;
    }
}
