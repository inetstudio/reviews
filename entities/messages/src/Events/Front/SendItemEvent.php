<?php

namespace InetStudio\Reviews\Messages\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Events\Front\SendItemEventContract;

/**
 * Class SendItemEvent.
 */
class SendItemEvent implements SendItemEventContract
{
    use SerializesModels;

    /**
     * @var MessageModelContract 
     */
    public $item;

    /**
     * SendItemEvent constructor.
     *
     * @param MessageModelContract $item
     */
    public function __construct(MessageModelContract $item)
    {
        $this->item = $item;
    }
}
