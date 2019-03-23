<?php

namespace InetStudio\Reviews\Messages\Listeners;

use InetStudio\Reviews\Messages\Contracts\Listeners\SendEmailToAdminListenerContract;

/**
 * Class SendEmailToAdminListener.
 */
class SendEmailToAdminListener implements SendEmailToAdminListenerContract
{
    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        $item = $event->item;

        if (config('reviews_messages.mails_admins.send')) {
            if (config('reviews_messages.queue.enable')) {
                $queue = config('reviews_messages.queue.name') ?? 'reviews_notify';

                $item->notify(
                    app()->make('InetStudio\Reviews\Messages\Contracts\Notifications\NewItemQueueableNotificationContract', compact('item'))
                        ->onQueue($queue)
                );
            } else {
                $item->notify(
                    app()->make('InetStudio\Reviews\Messages\Contracts\Notifications\NewItemNotificationContract', compact('item'))
                );
            }
        }
    }
}
