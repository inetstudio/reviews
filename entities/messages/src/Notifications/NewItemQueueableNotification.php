<?php

namespace InetStudio\Reviews\Messages\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use InetStudio\Reviews\Messages\Contracts\Notifications\NewItemQueueableNotificationContract;

/**
 * Class NewItemQueueableNotification.
 */
class NewItemQueueableNotification extends NewItemNotification implements ShouldQueue, NewItemQueueableNotificationContract
{
    use Queueable;
}
