<?php

namespace InetStudio\Reviews\Messages\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param MessageModelContract $model
     */
    public function __construct(MessageModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Получаем объект по id (для отображения).
     *
     * @param int $id
     * @param array $params
     *
     * @return MessageModelContract|null
     */
    public function getItemByIdForDisplay(int $id = 0, array $params = []): ?MessageModelContract
    {
        $item = $this->getItemById($id, $params);

        if ($item->id && ! $item->is_read) {
            $item->update([
                'is_read' => true,
            ]);
        }

        return $item;
    }

    /**
     * Сохраняем модель.
     *
     * @param array $data
     * @param int $id
     *
     * @return MessageModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): MessageModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $data = Arr::only($data, $this->model->getFillable());

        $item = $this->saveModel($data, $id);

        event(app()->make(
            'InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyItemEventContract',
            compact('item'))
        );

        Session::flash('success', 'Отзыв успешно '.$action);

        return $item;
    }

    /**
     * Получаем количество непрочитанных отзывов.
     *
     * @return int
     */
    public function getUnreadMessagesCount(): int
    {
        return $this->model::unread()->count();
    }
}
