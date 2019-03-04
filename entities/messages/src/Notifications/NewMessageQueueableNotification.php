<?php

namespace InetStudio\Reviews\Messages\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use InetStudio\Reviews\Messages\Contracts\Notifications\NewMessageQueueableNotificationContract;

/**
 * Class NewMessageQueueableNotification.
 */
class NewMessageQueueableNotification extends NewMessageNotification implements ShouldQueue, NewMessageQueueableNotificationContract
{
    use Queueable;
}
