<?php

namespace InetStudio\Reviews\Sites\Services\Back;

use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Repositories\SitesRepositoryContract;
use InetStudio\Reviews\Sites\Contracts\Services\Back\SitesObserverServiceContract;

/**
 * Class SitesObserverService.
 */
class SitesObserverService implements SitesObserverServiceContract
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
     * Событие "объект создается".
     *
     * @param SiteModelContract $item
     */
    public function creating(SiteModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param SiteModelContract $item
     */
    public function created(SiteModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param SiteModelContract $item
     */
    public function updating(SiteModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param SiteModelContract $item
     */
    public function updated(SiteModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param SiteModelContract $item
     */
    public function deleting(SiteModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param SiteModelContract $item
     */
    public function deleted(SiteModelContract $item): void
    {
    }
}
