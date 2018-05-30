<?php

namespace InetStudio\Reviews\Sites\Observers;

use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Observers\SiteObserverContract;

/**
 * Class SiteObserver.
 */
class SiteObserver implements SiteObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * SiteObserver constructor.
     */
    public function __construct()
    {
        $this->services['sitesObserver'] = app()->make('InetStudio\Reviews\Sites\Contracts\Services\Back\SitesObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param SiteModelContract $item
     */
    public function creating(SiteModelContract $item): void
    {
        $this->services['sitesObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param SiteModelContract $item
     */
    public function created(SiteModelContract $item): void
    {
        $this->services['sitesObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param SiteModelContract $item
     */
    public function updating(SiteModelContract $item): void
    {
        $this->services['sitesObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param SiteModelContract $item
     */
    public function updated(SiteModelContract $item): void
    {
        $this->services['sitesObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param SiteModelContract $item
     */
    public function deleting(SiteModelContract $item): void
    {
        $this->services['sitesObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param SiteModelContract $item
     */
    public function deleted(SiteModelContract $item): void
    {
        $this->services['sitesObserver']->deleted($item);
    }
}
