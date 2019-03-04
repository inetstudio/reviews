<?php

namespace InetStudio\Reviews\Messages\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\Reviews\Messages\Contracts\Events\Front\SendMessageEventContract;

/**
 * Class SendMessageEvent.
 */
class SendMessageEvent implements SendMessageEventContract
{
    use SerializesModels;

    public $object;

    /**
     * SendMessageEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
