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
        $message = $event->object;

        if (config('reviews_messages.mails_admins.send')) {
            if (config('reviews_messages.queue.enable')) {
                $queue = config('reviews_messages.queue.name') ?? 'reviews_notify';

                $message->notify(
                    app()->makeWith('InetStudio\Reviews\Messages\Contracts\Notifications\NewReviewQueueableNotificationContract', compact('message'))
                        ->onQueue($queue)
                );
            } else {
                $message->notify(
                    app()->makeWith('InetStudio\Reviews\Messages\Contracts\Notifications\NewReviewsNotificationContract', compact('message'))
                );
            }
        }
    }
}
