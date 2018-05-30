<?php

namespace InetStudio\Reviews\Messages\Services\Front;

use InetStudio\Reviews\Messages\Contracts\Services\Front\MessagesServiceContract;
use InetStudio\Reviews\Messages\Contracts\Repositories\MessagesRepositoryContract;

/**
 * Class MessagesService.
 */
class MessagesService implements MessagesServiceContract
{
    /**
     * @var MessagesRepositoryContract
     */
    private $repository;

    /**
     * MessagesService constructor.
     *
     * @param MessagesRepositoryContract $repository
     */
    public function __construct(MessagesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
