<?php

namespace InetStudio\Reviews\Messages\Listeners\Front;

use InetStudio\Reviews\Messages\Contracts\Listeners\Front\AttachUserToReviewsListenerContract;

/**
 * Class AttachUserToReviewsListener.
 */
class AttachUserToReviewsListener implements AttachUserToReviewsListenerContract
{
    /**
     * Handle the event.
     *
     * @param $event
     *
     * @return void
     */
    public function handle($event): void
    {
        $commentsService = app()->make('InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract');

        $user = $event->user;

        $items = $commentsService->model::where([
            ['user_id', '=', 0],
            ['email', '=', $user->email],
        ]);

        foreach ($items as $item) {
            $data = [
                'user_id' => $user->id,
                'name' => $user->name,
            ];

            $item->update($data);
        }
    }
}
