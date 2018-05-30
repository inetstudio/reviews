<?php

namespace InetStudio\Reviews\Sites\Http\Responses\Back\Utility;

use League\Fractal\Manager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\Reviews\Sites\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class SuggestionsResponse.
 */
class SuggestionsResponse implements SuggestionsResponseContract, Responsable
{
    /**
     * @var array
     */
    private $suggestions;

    /**
     * @var string
     */
    private $type;

    /**
     * SuggestionsResponse constructor.
     *
     * @param Collection $suggestions
     * @param string $type
     */
    public function __construct(Collection $suggestions, string $type)
    {
        $this->suggestions = $suggestions;
        $this->type = $type;
    }

    /**
     * Возвращаем slug по заголовку объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $resource = (app()->makeWith(
            'InetStudio\Reviews\Sites\Contracts\Transformers\Back\SuggestionTransformerContract', [
            'type' => $this->type,
        ]))->transformCollection($this->suggestions);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        if ($this->type == 'autocomplete') {
            $data['suggestions'] = $transformation['data'];
        } else {
            $data['items'] = $transformation['data'];
        }

        return response()->json($data);
    }
}
