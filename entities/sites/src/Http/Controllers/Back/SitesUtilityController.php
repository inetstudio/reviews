<?php

namespace InetStudio\Reviews\Sites\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\Reviews\Sites\Http\Responses\Back\Utility\SuggestionsResponse;
use InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back\SitesUtilityControllerContract;

/**
 * Class SitesUtilityController.
 */
class SitesUtilityController extends Controller implements SitesUtilityControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * SitesController constructor.
     */
    public function __construct()
    {
        $this->services['sites'] = app()->make(
            'InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract'
        );
    }

    /**
     * Возвращаем статьи для поля.
     *
     * @param Request $request
     *
     * @return SuggestionsResponse
     */
    public function getSuggestions(Request $request): SuggestionsResponse
    {
        $search = $request->get('q');
        $type = $request->get('type') ?? '';

        $suggestions = $this->services['sites']->getSuggestions($search);

        return app()->makeWith(
            'InetStudio\Reviews\Sites\Http\Responses\Back\Utility\SuggestionsResponse',
            compact('suggestions', 'type')
        );
    }
}
