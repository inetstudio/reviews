<?php

namespace InetStudio\Reviews\Sites\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\Reviews\Sites\Contracts\Events\Back\ModifyItemEventContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var SiteModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  SiteModelContract  $item
     */
    public function __construct(SiteModelContract $item)
    {
        $this->item = $item;
    }
}
