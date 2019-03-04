<?php

namespace InetStudio\Reviews\Sites\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Reviews\Sites\Contracts\Services\Back\SitesDataTableServiceContract;
use InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesDataControllerContract;

/**
 * Class SitesDataController.
 */
class SitesDataController extends Controller implements SitesDataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param SitesDataTableServiceContract $dataTableService
     *
     * @return mixed
     */
    public function data(SitesDataTableServiceContract $dataTableService)
    {
        return $dataTableService->ajax();
    }
}
