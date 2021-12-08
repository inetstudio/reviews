<?php

namespace InetStudio\Reviews\Sites\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  SiteModelContract  $model
     */
    public function __construct(SiteModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return SiteModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): SiteModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        resolve(
            'InetStudio\UploadsPackage\Uploads\Contracts\Actions\AttachMediaToObjectActionContract',
            [
                'item' => $item,
                'media' => Arr::get($data, 'media', []),
            ]
        )->execute();

        event(app()->make('InetStudio\Reviews\Sites\Contracts\Events\Back\ModifyItemEventContract', compact('item')));

        Session::flash('success', 'Сайт «'.$item->getAttribute('name').'» успешно '.$action);

        return $item;
    }
}
