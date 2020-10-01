<?php

namespace InetStudio\Reviews\Messages\Contracts\Listeners;

/**
 * Interface SendEmailToAdminListenerContract.
 */
interface SendEmailToAdminListenerContract
{
    public function handle($event): void;
}
