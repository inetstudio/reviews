<?php

namespace InetStudio\Reviews\Messages\Services\Back;

use InetStudio\AdminPanel\Base\Services\Back\BaseService;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesModerateServiceContract;

/**
 * Class MessagesModerateService.
 */
class MessagesModerateService extends BaseService implements MessagesModerateServiceContract
{
    /**
     * MessagesModerateService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract'));
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

            event(app()->makeWith('InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyMessageEventContract', [
                'object' => $item,
            ]));
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

            event(app()->makeWith('InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyMessageEventContract', [
                'object' => $item,
            ]));
        }

        return true;
    }
}
