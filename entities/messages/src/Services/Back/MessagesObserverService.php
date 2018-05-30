<?php

namespace InetStudio\Reviews\Messages\Services\Back;

use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Repositories\MessagesRepositoryContract;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesObserverServiceContract;

/**
 * Class MessagesObserverService.
 */
class MessagesObserverService implements MessagesObserverServiceContract
{
    /**
     * @var MessagesRepositoryContract
     */
    private $repository;

    /**
     * MessagesService constructor.
     *
     * @param MessagesRepositoryContract $repository
     */
    public function __construct(MessagesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Событие "объект создается".
     *
     * @param MessageModelContract $item
     */
    public function creating(MessageModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param MessageModelContract $item
     */
    public function created(MessageModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param MessageModelContract $item
     */
    public function updating(MessageModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param MessageModelContract $item
     */
    public function updated(MessageModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param MessageModelContract $item
     */
    public function deleting(MessageModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param MessageModelContract $item
     */
    public function deleted(MessageModelContract $item): void
    {
    }
}
