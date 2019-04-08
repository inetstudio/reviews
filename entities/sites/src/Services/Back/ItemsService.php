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

        $data = Arr::only($data, $this->model->getFillable());

        $item = $this->saveModel($data, $id);

        $images = (config('reviews_sites.images.conversions.site')) ? array_keys(config('reviews_sites.images.conversions.site')) : [];
        app()->make('InetStudio\Uploads\Contracts\Services\Back\ImagesServiceContract')
            ->attachToObject(request(), $item, $images, 'reviews_sites', 'site');

        event(app()->make('InetStudio\Reviews\Sites\Contracts\Events\Back\ModifyItemEventContract', compact('item')));

        Session::flash('success', 'Сайт «'.$item->getAttribute('name').'» успешно '.$action);

        return $item;
    }
}
