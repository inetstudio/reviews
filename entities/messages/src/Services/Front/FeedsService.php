<?php

namespace InetStudio\Reviews\Messages\Services\Front;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Services\Front\FeedsServiceContract;

/**
 * Class FeedsService.
 */
class FeedsService extends BaseService implements FeedsServiceContract
{
    /**
     * FeedsService constructor.
     *
     * @param  MessageModelContract  $model
     */
    public function __construct(MessageModelContract $model)
    {
        parent::__construct($model);
    }
}
