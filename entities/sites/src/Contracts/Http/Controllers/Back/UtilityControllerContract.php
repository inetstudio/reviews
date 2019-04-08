<?php

namespace InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\Reviews\Sites\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Interface UtilityControllerContract.
 */
interface UtilityControllerContract
{
    /**
     * Возвращаем сайты для поля.
     *
     * @param  UtilityServiceContract  $utilityService
     * @param  Request  $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(
        UtilityServiceContract $utilityService,
        Request $request
    ): SuggestionsResponseContract;
}
