<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\Reviews\Messages\Contracts\Services\Back\DataTableServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveItemRequestContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\ResourceControllerContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\FormResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\SaveResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\ShowResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

/**
 * Class ResourceController.
 */
class ResourceController extends Controller implements ResourceControllerContract
{
    /**
     * Список объектов.
     *
     * @param DataTableServiceContract $dataTableService
     * 
     * @return IndexResponseContract
     */
    public function index(DataTableServiceContract $dataTableService): IndexResponseContract
    {
        $table = $dataTableService->html();

        return $this->app->make(IndexResponseContract::class, [
            'data' => compact('table'),
        ]);
    }

    /**
     * Получение объекта.
     *
     * @param ItemsServiceContract $resourceService
     * @param int $id
     *
     * @return ShowResponseContract
     */
    public function show(ItemsServiceContract $resourceService,
                         int $id = 0): ShowResponseContract
    {
        $item = $resourceService->getItemByIdForDisplay($id, [
            'columns' => ['title', 'user_link', 'rating'],
        ]);

        return $this->app->make(ShowResponseContract::class, compact('item'));
    }

    /**
     * Создание объекта.
     *
     * @param ItemsServiceContract $resourceService
     *
     * @return FormResponseContract
     */
    public function create(ItemsServiceContract $resourceService): FormResponseContract
    {
        $item = $resourceService->getItemById();

        return $this->app->make(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param ItemsServiceContract $resourceService
     * @param SaveItemRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(ItemsServiceContract $resourceService,
                          SaveItemRequestContract $request): SaveResponseContract
    {
        return $this->save($resourceService, $request);
    }

    /**
     * Редактирование объекта.
     *
     * @param ItemsServiceContract $resourceService
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit(ItemsServiceContract $resourceService,
                         int $id = 0): FormResponseContract
    {
        $item = $resourceService->getItemByIdForDisplay($id, [
            'columns' => ['title', 'user_link', 'rating'],
        ]);

        return $this->app->make(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param ItemsServiceContract $resourceService
     * @param SaveItemRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(ItemsServiceContract $resourceService,
                           SaveItemRequestContract $request,
                           int $id = 0): SaveResponseContract
    {
        return $this->save($resourceService, $request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param ItemsServiceContract $resourceService
     * @param SaveItemRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    protected function save(ItemsServiceContract $resourceService,
                            SaveItemRequestContract $request,
                            int $id = 0): SaveResponseContract
    {
        $data = $request->all();

        $item = $resourceService->save($data, $id);

        return $this->app->make(SaveResponseContract::class, compact('item'));
    }

    /**
     * Удаление объекта.
     *
     * @param ItemsServiceContract $resourceService
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(ItemsServiceContract $resourceService,
                            int $id = 0): DestroyResponseContract
    {
        $result = $resourceService->destroy($id);

        return $this->app->make(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
