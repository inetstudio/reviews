<?php

namespace InetStudio\Reviews\Sites\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesDataControllerContract;

/**
 * Class SitesDataController.
 */
class SitesDataController extends Controller implements SitesDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * SitesController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\Reviews\Sites\Contracts\Services\Back\SitesDataTableServiceContract');
    }

    /**
     * Получаем данные для отображения в таблице.
     *
     * @return mixed
     */
    public function data()
    {
        return $this->services['dataTables']->ajax();
    }
}
