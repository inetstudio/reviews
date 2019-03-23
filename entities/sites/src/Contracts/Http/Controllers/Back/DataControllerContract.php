<?php

namespace InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back;

use Illuminate\Http\JsonResponse;
use InetStudio\Reviews\Sites\Contracts\Services\Back\DataTableServiceContract;

/**
 * Interface DataControllerContract.
 */
interface DataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param DataTableServiceContract $dataTableService
     *
     * @return JsonResponse
     */
    public function data(DataTableServiceContract $dataTableService): JsonResponse;
}
