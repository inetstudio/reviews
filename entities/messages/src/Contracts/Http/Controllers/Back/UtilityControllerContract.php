<?php

namespace InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\Reviews\Messages\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Interface UtilityControllerContract.
 */
interface UtilityControllerContract
{
    /**
     * Возвращаем сообщения для поля.
     *
     * @param UtilityServiceContract $utilityService
     * @param Request $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(UtilityServiceContract $utilityService,
                                   Request $request): SuggestionsResponseContract;
}
