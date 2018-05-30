<?php

namespace InetStudio\Reviews\Sites\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Reviews\Sites\Contracts\Http\Requests\Back\SaveSiteRequestContract;
use InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesControllerContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\FormResponseContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\SaveResponseContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\IndexResponseContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\DestroyResponseContract;

/**
 * Class SitesController.
 */
class SitesController extends Controller implements SitesControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * SitesController constructor.
     */
    public function __construct()
    {
        $this->services['sites'] = app()->make('InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\Reviews\Sites\Contracts\Services\Back\SitesDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\IndexResponseContract', [
            'data' => compact('table'),
        ]);
    }

    /**
     * Добавление объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['sites']->getSiteObject();

        return app()->makeWith('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveSiteRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveSiteRequestContract $request): SaveResponseContract
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
        $item = $this->services['sites']->getSiteObject($id);

        return app()->makeWith('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveSiteRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveSiteRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveSiteRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveSiteRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['sites']->save($request, $id);

        return app()->makeWith('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\SaveResponseContract', [
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
        $result = $this->services['sites']->destroy($id);

        return app()->makeWith('InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Sites\DestroyResponseContract', [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
