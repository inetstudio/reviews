<?php

namespace InetStudio\Reviews\Messages\Services\Back;

use Illuminate\Support\Facades\Session;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract;
use InetStudio\Reviews\Messages\Contracts\Repositories\MessagesRepositoryContract;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveMessageRequestContract;

/**
 * Class MessagesService.
 */
class MessagesService implements MessagesServiceContract
{
    /**
     * @var MessagesRepositoryContract
     */
    private $repository;

    /**
     * MessagesService constructor.
     *
     * @param MessagesRepositoryContract $repository
     */
    public function __construct(MessagesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем объект модели.
     *
     * @param int $id
     *
     * @return MessageModelContract
     */
    public function getMessageObject(int $id = 0)
    {
        return $this->repository->getItemByID($id);
    }

    /**
     * Получаем объекты по списку id.
     *
     * @param array|int $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getMessagesByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveMessageRequestContract $request
     * @param int $id
     *
     * @return MessageModelContract
     */
    public function save(SaveMessageRequestContract $request, int $id): MessageModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';
        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        event(app()->makeWith('InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyMessageEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Отзыв успешно '.$action);

        return $item;
    }

    /**
     * Удаляем модель.
     *
     * @param $id
     *
     * @return bool
     */
    public function destroy(int $id): ?bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     *
     * @return array
     */
    public function getSuggestions(string $search): array
    {
        $items = $this->repository->searchItemsByField('message', $search);

        return $items;
    }
}
