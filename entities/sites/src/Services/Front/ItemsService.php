<?php

namespace InetStudio\Reviews\Sites\Services\Front;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * SitesService constructor.
     *
     * @param  SiteModelContract  $model
     */
    public function __construct(SiteModelContract $model)
    {
        parent::__construct($model);
    }
}
