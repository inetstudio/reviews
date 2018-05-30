<?php

namespace InetStudio\Reviews\Sites\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\Reviews\Sites\Contracts\Events\Back\ModifySiteEventContract;

/**
 * Class ModifySiteEvent.
 */
class ModifySiteEvent implements ModifySiteEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifySiteEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
