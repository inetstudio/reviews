<?php

namespace InetStudio\Reviews\Sites\Services\Front;

use InetStudio\Reviews\Sites\Contracts\Services\Front\SitesServiceContract;
use InetStudio\Reviews\Sites\Contracts\Repositories\SitesRepositoryContract;

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
}
