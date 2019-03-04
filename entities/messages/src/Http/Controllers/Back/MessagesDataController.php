<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesDataTableServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesDataControllerContract;

/**
 * Class MessagesDataController.
 */
class MessagesDataController extends Controller implements MessagesDataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param MessagesDataTableServiceContract $dataTableService
     *
     * @return mixed
     */
    public function data(MessagesDataTableServiceContract $dataTableService)
    {
        return $dataTableService->ajax();
    }
}
