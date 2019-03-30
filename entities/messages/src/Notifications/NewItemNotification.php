<?php

namespace InetStudio\Reviews\Messages\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\Reviews\Messages\Contracts\Mail\NewItemMailContract;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Notifications\NewItemNotificationContract;

/**
 * Class NewItemNotification.
 */
class NewItemNotification extends Notification implements NewItemNotificationContract
{
    /**
     * @var MessageModelContract
     */
    protected $item;

    /**
     * NewItemNotification constructor.
     *
     * @param MessageModelContract $item
     */
    public function __construct(MessageModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return [
            'mail', 'database',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     *
     * @return NewItemMailContract
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): NewItemMailContract
    {
        return app()->make(NewItemMailContract::class, ['item' => $this->item]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'review_id' => $this->item->id,
        ];
    }
}
