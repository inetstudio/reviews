<?php

namespace InetStudio\Reviews\Sites\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract;
use InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesUtilityControllerContract;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class SitesUtilityController.
 */
class SitesUtilityController extends Controller implements SitesUtilityControllerContract
{
    /**
     * Возвращаем статьи для поля.
     *
     * @param SitesServiceContract $sitesService
     * @param Request $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(SitesServiceContract $sitesService, Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q');
        $type = $request->get('type');

        $data = $sitesService->getSuggestions($search, $type);

        return app()->makeWith(SuggestionsResponseContract::class, [
            'suggestions' => $data,
        ]);
    }
}
