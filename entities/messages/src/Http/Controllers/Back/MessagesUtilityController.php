<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesUtilityControllerContract;

/**
 * Class MessagesUtilityController.
 */
class MessagesUtilityController extends Controller implements MessagesUtilityControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * MessagesController constructor.
     */
    public function __construct()
    {
        $this->services['messages'] = app()->make(
            'InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract'
        );
    }

    /**
     * Возвращаем статьи для поля.
     *
     * @param Request $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q');
        $type = $request->get('type') ?? '';

        $suggestions = $this->services['messages']->getSuggestions($search);

        return app()->makeWith(
            'InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            compact('suggestions', 'type')
        );
    }
}
