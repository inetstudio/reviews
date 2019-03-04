<?php

namespace InetStudio\Reviews\Messages\Services\Back;

use Illuminate\Support\Arr;
use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Base\Services\Back\BaseService;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract;

/**
 * Class MessagesService.
 */
class MessagesService extends BaseService implements MessagesServiceContract
{
    /**
     * MessagesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract'));
    }

    /**
     * Получаем объект по id (для отображения).
     *
     * @param int $id
     * @param array $params
     *
     * @return mixed
     */
    public function getItemByIdForDisplay(int $id = 0, array $params = [])
    {
        $item = $this->getItemById($id, $params);

        if ($item->id && ! $item->is_read) {
            $item->update([
                'is_read' => true,
            ]);
        }

        return $item;
    }

    /**
     * Сохраняем модель.
     *
     * @param array $data
     * @param int $id
     *
     * @return MessageModelContract
     */
    public function save(array $data, int $id): MessageModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $item = $this->saveModel(Arr::only($data, $this->model->getFillable()), $id);

        event(app()->makeWith('InetStudio\Reviews\Messages\Contracts\Events\Back\ModifyMessageEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Отзыв успешно '.$action);

        return $item;
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     * @param $type
     *
     * @return array
     */
    public function getSuggestions(string $search, $type): array
    {
        $items = $this->model::where([['message', 'LIKE', '%'.$search.'%']])->get();

        $resource = (app()->makeWith('InetStudio\Reviews\Messages\Contracts\Transformers\Back\SuggestionTransformerContract', [
            'type' => $type,
        ]))->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        if ($type && $type == 'autocomplete') {
            $data['suggestions'] = $transformation['data'];
        } else {
            $data['items'] = $transformation['data'];
        }

        return $data;
    }

    /**
     * Получаем количество непрочитанных отзывов.
     *
     * @return mixed
     */
    public function getUnreadMessagesCount()
    {
        return $this->model::unread()->count();
    }
}
