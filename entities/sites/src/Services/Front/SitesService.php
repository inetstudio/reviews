<?php

namespace InetStudio\Reviews\Sites\Services\Front;

use InetStudio\AdminPanel\Base\Services\Front\BaseService;
use InetStudio\Reviews\Sites\Contracts\Services\Front\SitesServiceContract;

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
}
