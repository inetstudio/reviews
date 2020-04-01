<?php

namespace InetStudio\Reviews\Messages\Services\Front;

use Illuminate\Support\Arr;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * @var array
     */
    public $availableTypes = [];

    /**
     * ItemsService constructor.
     *
     * @param  MessageModelContract  $model
     *
     * @throws BindingResolutionException
     */
    public function __construct(MessageModelContract $model)
    {
        parent::__construct($model);

        $this->availableTypes = config('reviews_messages.reviewable', []);
    }

    /**
     * Сохраняем отзыв.
     *
     * @param  array  $data
     * @param  string  $type
     * @param  int  $id
     *
     * @return MessageModelContract|null
     *
     * @throws BindingResolutionException
     */
    public function saveMessage(
        array $data,
        string $type,
        int $id
    ): ?MessageModelContract {
        if (! isset($this->availableTypes[$type])) {
            return null;
        }

        $usersService = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\ItemsServiceContract');

        $request = request();

        $model = app()->make($this->availableTypes[$type]);
        $reviewable = $model::find($id);

        if (! $reviewable) {
            return null;
        }

        $files = [
            'files' => $data['files'],
        ];

        $data = array_merge(
            $data, [
            'reviewable_id' => $reviewable->id,
            'reviewable_type' => $reviewable->getTable(),
            'user_id' => $usersService->getUserId(),
            'name' => $usersService->getUserName($request),
            'email' => $usersService->getUserEmail($request),
            'is_active' => 0,
        ]
        );

        $data = Arr::only($data, $this->model->getFillable());

        $item = $this->saveModel($data);

        app()->make('InetStudio\Uploads\Contracts\Services\Front\ItemsServiceContract')
            ->attachFilesToObject($item, $files, 'reviews_messages');

        if (isset($item['id'])) {
            event(
                app()->make(
                    'InetStudio\Reviews\Messages\Contracts\Events\Front\SendItemEventContract',
                    compact('item')
                )
            );
        }

        return $item;
    }

    /**
     * Получаем отзывы по типу и id материала.
     *
     * @param  string  $type
     * @param  int  $id
     * @param  array  $params
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function getItemsByTypeAndId(string $type, int $id, array $params = [])
    {
        if (! isset($this->availableTypes[$type])) {
            return collect([]);
        }

        $model = app()->make($this->availableTypes[$type]);

        $item = $model::find($id);

        if (! ($item && $item->id)) {
            return collect([]);
        }

        return $item->reviews;
    }
}
