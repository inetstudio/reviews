<?php

namespace InetStudio\Reviews\Messages\Contracts\Listeners\Front;

/**
 * Interface AttachUserToReviewsListenerContract.
 */
interface AttachUserToReviewsListenerContract
{
    public function handle($event): void;
}
