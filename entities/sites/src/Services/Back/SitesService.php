<?php

namespace InetStudio\Reviews\Sites\Services\Back;

use Illuminate\Support\Arr;
use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Base\Services\Back\BaseService;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract;

/**
 * Class SitesService.
 */
class SitesService extends BaseService implements SitesServiceContract
{
    /**
     * SitesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract'));
    }

    /**
     * Сохраняем модель.
     *
     * @param array $data
     * @param int $id
     *
     * @return SiteModelContract
     */
    public function save(array $data, int $id): SiteModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $item = $this->saveModel(Arr::only($data, $this->model->getFillable()), $id);

        $images = (config('reviews_sites.images.conversions.site')) ? array_keys(config('reviews_sites.images.conversions.site')) : [];
        app()->make('InetStudio\Uploads\Contracts\Services\Back\ImagesServiceContract')
            ->attachToObject(request(), $item, $images, 'reviews_sites', 'site');

        event(app()->makeWith('InetStudio\Reviews\Sites\Contracts\Events\Back\ModifySiteEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Сайт «'.$item->getAttribute('name').'» успешно '.$action);

        return $item;
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     * @param $type
     *
     * @return array
     */
    public function getSuggestions(string $search, $type): array
    {
        $items = $this->model::where([['name', 'LIKE', '%'.$search.'%']])->get();

        $resource = (app()->makeWith('InetStudio\Reviews\Sites\Contracts\Transformers\Back\SuggestionTransformerContract', [
            'type' => $type,
        ]))->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        if ($type && $type == 'autocomplete') {
            $data['suggestions'] = $transformation['data'];
        } else {
            $data['items'] = $transformation['data'];
        }

        return $data;
    }
}
