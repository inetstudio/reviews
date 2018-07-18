<?php

namespace InetStudio\Reviews\Sites\Services\Back;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract;
use InetStudio\Reviews\Sites\Contracts\Repositories\SitesRepositoryContract;
use InetStudio\Reviews\Sites\Contracts\Http\Requests\Back\SaveSiteRequestContract;

/**
 * Class SitesService.
 */
class SitesService implements SitesServiceContract
{
    /**
     * @var SitesRepositoryContract
     */
    private $repository;

    /**
     * SitesService constructor.
     *
     * @param SitesRepositoryContract $repository
     */
    public function __construct(SitesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем объект модели.
     *
     * @param int $id
     *
     * @return SiteModelContract
     */
    public function getSiteObject(int $id = 0)
    {
        return $this->repository->getItemByID($id);
    }

    /**
     * Получаем объекты по списку id.
     *
     * @param array|int $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getSitesByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveSiteRequestContract $request
     * @param int $id
     *
     * @return SiteModelContract
     */
    public function save(SaveSiteRequestContract $request, int $id): SiteModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        $images = (config('reviews_sites.images.conversions.site')) ? array_keys(config('reviews_sites.images.conversions.site')) : [];
        app()->make('InetStudio\Uploads\Contracts\Services\Back\ImagesServiceContract')
            ->attachToObject($request, $item, $images, 'reviews_sites', 'site');

        event(app()->makeWith('InetStudio\Reviews\Sites\Contracts\Events\Back\ModifySiteEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Сайт «'.$item->getAttribute('name').'» успешно '.$action);

        return $item;
    }

    /**
     * Удаляем модель.
     *
     * @param $id
     *
     * @return bool
     */
    public function destroy(int $id): ?bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     *
     * @return Collection
     */
    public function getSuggestions(string $search): Collection
    {
        $items = $this->repository->searchItems([['name', 'LIKE', '%'.$search.'%']]);

        return $items;
    }
}
