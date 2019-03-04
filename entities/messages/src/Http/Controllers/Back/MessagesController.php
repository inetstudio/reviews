<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveMessageRequestContract;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesDataTableServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesControllerContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\FormResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\SaveResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\ShowResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

/**
 * Class MessagesController.
 */
class MessagesController extends Controller implements MessagesControllerContract
{
    /**
     * Список объектов.
     *
     * @param MessagesDataTableServiceContract $dataTableService
     * 
     * @return IndexResponseContract
     */
    public function index(MessagesDataTableServiceContract $dataTableService): IndexResponseContract
    {
        $table = $dataTableService->html();

        return app()->makeWith(IndexResponseContract::class, [
            'data' => compact('table'),
        ]);
    }

    /**
     * Получение объекта.
     *
     * @param MessagesServiceContract $messagesService
     * @param int $id
     *
     * @return ShowResponseContract
     */
    public function show(MessagesServiceContract $messagesService, int $id = 0): ShowResponseContract
    {
        $item = $messagesService->getItemByIdForDisplay($id, [
            'columns' => ['title', 'user_link', 'rating'],
        ]);

        return app()->makeWith(ShowResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Добавление объекта.
     *
     * @param MessagesServiceContract $messagesService
     *
     * @return FormResponseContract
     */
    public function create(MessagesServiceContract $messagesService): FormResponseContract
    {
        $item = $messagesService->getItemById();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param MessagesServiceContract $messagesService
     * @param SaveMessageRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(MessagesServiceContract $messagesService, SaveMessageRequestContract $request): SaveResponseContract
    {
        return $this->save($messagesService, $request);
    }

    /**
     * Редактирование объекта.
     *
     * @param MessagesServiceContract $messagesService
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit(MessagesServiceContract $messagesService, int $id = 0): FormResponseContract
    {
        $item = $messagesService->getItemByIdForDisplay($id, [
            'columns' => ['title', 'user_link', 'rating'],
        ]);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param MessagesServiceContract $messagesService
     * @param SaveMessageRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(MessagesServiceContract $messagesService, SaveMessageRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($messagesService, $request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param MessagesServiceContract $messagesService
     * @param SaveMessageRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    protected function save(MessagesServiceContract $messagesService, SaveMessageRequestContract $request, int $id = 0): SaveResponseContract
    {
        $data = $request->all();

        $item = $messagesService->save($data, $id);

        return app()->makeWith(SaveResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param MessagesServiceContract $messagesService
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(MessagesServiceContract $messagesService, int $id = 0): DestroyResponseContract
    {
        $result = $messagesService->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
