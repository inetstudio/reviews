<?php

namespace InetStudio\Reviews\Messages\Observers;

use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Observers\MessageObserverContract;

/**
 * Class MessageObserver.
 */
class MessageObserver implements MessageObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * MessageObserver constructor.
     */
    public function __construct()
    {
        $this->services['messagesObserver'] = app()->make('InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param MessageModelContract $item
     */
    public function creating(MessageModelContract $item): void
    {
        $this->services['messagesObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param MessageModelContract $item
     */
    public function created(MessageModelContract $item): void
    {
        $this->services['messagesObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param MessageModelContract $item
     */
    public function updating(MessageModelContract $item): void
    {
        $this->services['messagesObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param MessageModelContract $item
     */
    public function updated(MessageModelContract $item): void
    {
        $this->services['messagesObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param MessageModelContract $item
     */
    public function deleting(MessageModelContract $item): void
    {
        $this->services['messagesObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param MessageModelContract $item
     */
    public function deleted(MessageModelContract $item): void
    {
        $this->services['messagesObserver']->deleted($item);
    }
}
