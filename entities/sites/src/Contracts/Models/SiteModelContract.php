<?php

namespace InetStudio\Reviews\Sites\Contracts\Models;

use ArrayAccess;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Queue\QueueableEntity;

/**
 * Interface SiteModelContract.
 */
interface SiteModelContract extends ArrayAccess, Arrayable, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    /**
     * Reload a fresh model instance from the database.
     *
     * @param  array|string  $with
     *
     * @return static|null
     */
    public function fresh($with = []);
}
