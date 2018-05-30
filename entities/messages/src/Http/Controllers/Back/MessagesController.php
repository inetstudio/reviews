<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveMessageRequestContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesControllerContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\FormResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\SaveResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\ShowResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\IndexResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\DestroyResponseContract;

/**
 * Class MessagesController.
 */
class MessagesController extends Controller implements MessagesControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * MessagesController constructor.
     */
    public function __construct()
    {
        $this->services['messages'] = app()->make('InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\IndexResponseContract', [
            'data' => compact('table'),
        ]);
    }

    /**
     * Получение объекта.
     *
     * @param int $id
     *
     * @return ShowResponseContract
     */
    public function show(int $id = 0): ShowResponseContract
    {
        $item = $this->services['messages']->getMessageObject($id);

        return app()->makeWith('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\ShowResponseContract', [
            'item' => $item,
        ]);
    }

    /**
     * Добавление объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['messages']->getMessageObject();

        return app()->makeWith('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveMessageRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveMessageRequestContract $request): SaveResponseContract
    {
        return $this->save($request);
    }

    /**
     * Редактирование объекта.
     *
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit($id = 0): FormResponseContract
    {
        $item = $this->services['messages']->getMessageObject($id);

        return app()->makeWith('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveMessageRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveMessageRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveMessageRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveMessageRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['messages']->save($request, $id);

        return app()->makeWith('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\SaveResponseContract', [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(int $id = 0): DestroyResponseContract
    {
        $result = $this->services['messages']->destroy($id);

        return app()->makeWith('InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Messages\DestroyResponseContract', [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
