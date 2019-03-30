<?php

namespace InetStudio\Reviews\Messages\Listeners\Front;

use Illuminate\Contracts\Container\BindingResolutionException;
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
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $reviewsService = app()->make('InetStudio\Reviews\Messages\Contracts\Services\Back\ItemsServiceContract');

        $user = $event->user;

        $reviewsService->model::where([
            ['user_id', '=', 0],
            ['email', '=', $user->email],
        ])->update([
            'user_id' => $user->id,
            'name' => $user->name,
        ]);
    }
}
