<?php

namespace InetStudio\Reviews\Sites\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract;
use InetStudio\Reviews\Sites\Contracts\Http\Requests\Back\SaveSiteRequestContract;
use InetStudio\Reviews\Sites\Contracts\Services\Back\SitesDataTableServiceContract;
use InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesControllerContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\FormResponseContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\SaveResponseContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

/**
 * Class SitesController.
 */
class SitesController extends Controller implements SitesControllerContract
{
    /**
     * Список объектов.
     *
     * @param SitesDataTableServiceContract $dataTableService
     * 
     * @return IndexResponseContract
     */
    public function index(SitesDataTableServiceContract $dataTableService): IndexResponseContract
    {
        $table = $dataTableService->html();

        return app()->makeWith(IndexResponseContract::class, [
            'data' => compact('table'),
        ]);
    }

    /**
     * Добавление объекта.
     *
     * @param SitesServiceContract $sitesService
     * 
     * @return FormResponseContract
     */
    public function create(SitesServiceContract $sitesService): FormResponseContract
    {
        $item = $sitesService->getItemById();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SitesServiceContract $sitesService
     * @param SaveSiteRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SitesServiceContract $sitesService, SaveSiteRequestContract $request): SaveResponseContract
    {
        return $this->save($sitesService, $request);
    }

    /**
     * Редактирование объекта.
     *
     * @param SitesServiceContract $sitesService
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit(SitesServiceContract $sitesService, $id = 0): FormResponseContract
    {
        $item = $sitesService->getItemById($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SitesServiceContract $sitesService
     * @param SaveSiteRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SitesServiceContract $sitesService, SaveSiteRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($sitesService, $request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SitesServiceContract $sitesService
     * @param SaveSiteRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    protected function save(SitesServiceContract $sitesService, SaveSiteRequestContract $request, int $id = 0): SaveResponseContract
    {
        $data = $request->all();

        $item = $sitesService->save($data, $id);

        return app()->makeWith(SaveResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param SitesServiceContract $sitesService
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(SitesServiceContract $sitesService, int $id = 0): DestroyResponseContract
    {
        $result = $sitesService->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
