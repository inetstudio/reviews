<?php

namespace InetStudio\Reviews\Messages\Listeners;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\Reviews\Messages\Contracts\Listeners\SendEmailToAdminListenerContract;

/**
 * Class SendEmailToAdminListener.
 */
class SendEmailToAdminListener implements SendEmailToAdminListenerContract
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $item = $event->item;

        $send = config('reviews_messages.mails_admins.send', false);

        if (! $send) {
            return;
        }

        if (config('reviews_messages.queue.enable')) {
            $queue = config('reviews_messages.queue.name', 'reviews_notify');

            $item->notify(
                app()->make(
                    'InetStudio\Reviews\Messages\Contracts\Notifications\NewItemQueueableNotificationContract',
                    compact('item')
                )
                ->onQueue($queue)
            );

            return;
        }

        $item->notify(
            app()->make(
                'InetStudio\Reviews\Messages\Contracts\Notifications\NewItemNotificationContract',
                compact('item')
            )
        );
    }
}
