<?php

namespace InetStudio\Reviews\Sites\Http\Controllers\Back;

use Illuminate\Http\JsonResponse;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\Reviews\Sites\Contracts\Services\Back\DataTableServiceContract;
use InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\DataControllerContract;

/**
 * Class DataController.
 */
class DataController extends Controller implements DataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param DataTableServiceContract $dataTableService
     *
     * @return mixed
     */
    public function data(DataTableServiceContract $dataTableService): JsonResponse
    {
        return $dataTableService->ajax();
    }
}
