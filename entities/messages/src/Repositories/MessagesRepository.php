<?php

namespace InetStudio\Reviews\Messages\Repositories;

use Illuminate\Database\Eloquent\Builder;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Repositories\MessagesRepositoryContract;

/**
 * Class MessagesRepository.
 */
class MessagesRepository implements MessagesRepositoryContract
{
    /**
     * @var MessageModelContract
     */
    private $model;

    /**
     * MessagesRepository constructor.
     *
     * @param MessageModelContract $model
     */
    public function __construct(MessageModelContract $model)
    {
        $this->model = $model;
    }

    /**
     * Получаем модель репозитория.
     *
     * @return MessageModelContract
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Возвращаем объект по id, либо создаем новый.
     *
     * @param int $id
     *
     * @return MessageModelContract
     */
    public function getItemByID(int $id): MessageModelContract
    {
        return $this->model::find($id) ?? new $this->model;
    }

    /**
     * Возвращаем объекты по списку id.
     *
     * @param $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getItemsByIDs($ids, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery()->whereIn('id', (array) $ids);

        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Сохраняем объект.
     *
     * @param array $data
     * @param int $id
     *
     * @return MessageModelContract
     */
    public function save(array $data, int $id): MessageModelContract
    {
        $item = $this->getItemByID($id);
        $item->fill($data);
        $item->save();

        return $item;
    }

    /**
     * Удаляем объект.
     *
     * @param int $id
     *
     * @return bool
     */
    public function destroy($id): ?bool
    {
        return $this->getItemByID($id)->delete();
    }

    /**
     * Ищем объекты.
     *
     * @param array $conditions
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function searchItems(array $conditions, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery([])->where($conditions);

        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Получаем все объекты.
     *
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getAllItems(bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery(['created_at', 'updated_at']);

        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Получаем объекты по slug.
     *
     * @param string $slug
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getItemBySlug(string $slug, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery()->whereSlug($slug);

        if ($returnBuilder) {
            return $builder;
        }

        $item = $builder->first();

        return $item;
    }

    /**
     * Возвращаем запрос на получение объектов.
     *
     * @param array $extColumns
     * @param array $with
     *
     * @return Builder
     */
    protected function getItemsQuery($extColumns = [], $with = []): Builder
    {
        $defaultColumns = ['id', 'user_name', 'message', 'is_active'];

        $relations = [];

        return $this->model::select(array_merge($defaultColumns, $extColumns))
            ->with(array_intersect_key($relations, array_flip($with)));
    }
}
