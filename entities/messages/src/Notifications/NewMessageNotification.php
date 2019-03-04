<?php

namespace InetStudio\Reviews\Messages\Notifications;

use Illuminate\Notifications\Notification;
use InetStudio\Reviews\Messages\Mail\NewMessageMail;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Notifications\NewMessageNotificationContract;

/**
 * Class NewMessageNotification.
 */
class NewMessageNotification extends Notification implements NewMessageNotificationContract
{
    /**
     * @var MessageModelContract
     */
    protected $message;

    /**
     * NewMessageNotification constructor.
     *
     * @param MessageModelContract $message
     */
    public function __construct(MessageModelContract $message)
    {
        $this->message = $message;
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
     * @return NewMessageMail
     */
    public function toMail($notifiable): NewMessageMail
    {
        return new NewMessageMail($this->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'message_id' => $this->message->id,
        ];
    }
}
