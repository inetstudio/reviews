<?php

namespace InetStudio\Reviews\Messages\Services\Back;

use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesDataTableServiceContract;

/**
 * Class MessagesDataTableService.
 */
class MessagesDataTableService extends DataTable implements MessagesDataTableServiceContract
{
    /**
     * @var
     */
    public $model;

    /**
     * CommentsDataTableService constructor.
     */
    public function __construct()
    {
        $this->model = app()->make('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract');
    }

    /**
     * Запрос на получение данных таблицы.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function ajax()
    {
        $transformer = app()->make('InetStudio\Reviews\Messages\Contracts\Transformers\Back\MessageTransformerContract');

        return DataTables::of($this->query())
            ->setTransformer($transformer)
            ->rawColumns(['checkbox', 'read', 'active', 'material', 'actions'])
            ->make();
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = $this->model->buildQuery([
            'columns' => ['title', 'created_at'],
        ]);

        return $query;
    }

    /**
     * Генерация таблицы.
     *
     * @return Builder
     *
     * @throws \Throwable
     */
    public function html(): Builder
    {
        $table = app('datatables.html');

        return $table
            ->columns($this->getColumns())
            ->ajax($this->getAjaxOptions())
            ->parameters($this->getParameters());
    }

    /**
     * Получаем колонки.
     *
     * @return array
     *
     * @throws \Throwable
     */
    protected function getColumns(): array
    {
        return [
            ['data' => 'checkbox', 'name' => 'checkbox', 'title' => view('admin.module.reviews.messages::back.partials.datatables.checkbox')
                ->render(), 'orderable' => false, 'searchable' => false],
            ['data' => 'read', 'name' => 'is_read', 'title' => 'Прочитано', 'searchable' => false],
            ['data' => 'active', 'name' => 'is_active', 'title' => 'Активность', 'searchable' => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Имя'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Заголовок'],
            ['data' => 'message', 'name' => 'message', 'title' => 'Отзыв'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Действия', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Свойства ajax datatables.
     *
     * @return array
     */
    protected function getAjaxOptions(): array
    {
        return [
            'url' => route('back.reviews.messages.data.index'),
            'type' => 'POST',
        ];
    }

    /**
     * Свойства datatables.
     *
     * @return array
     */
    protected function getParameters(): array
    {
        $i18n = trans('admin::datatables');

        return [
            'order' => [7, 'desc'],
            'paging' => true,
            'pagingType' => 'full_numbers',
            'searching' => true,
            'info' => false,
            'searchDelay' => 350,
            'language' => $i18n,
        ];
    }
}
