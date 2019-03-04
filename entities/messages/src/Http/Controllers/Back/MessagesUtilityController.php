<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesUtilityControllerContract;

/**
 * Class MessagesUtilityController.
 */
class MessagesUtilityController extends Controller implements MessagesUtilityControllerContract
{
    /**
     * Возвращаем статьи для поля.
     *
     * @param MessagesServiceContract $messagesService
     * @param Request $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(MessagesServiceContract $messagesService, Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q');
        $type = $request->get('type');

        $data = $messagesService->getSuggestions($search, $type);

        return app()->makeWith(SuggestionsResponseContract::class, [
            'suggestions' => $data,
        ]);
    }
}
