<?php

namespace InetStudio\Reviews\Messages\Services\Front;

use Illuminate\Support\Collection;
use InetStudio\AdminPanel\Base\Services\Front\BaseService;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Services\Front\MessagesServiceContract;

/**
 * Class MessagesService.
 */
class MessagesService extends BaseService implements MessagesServiceContract
{
    public $availableTypes = [];

    /**
     * MessagesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract'));

        $types = config('reviews_messages.reviewable');

        foreach ($types ?? [] as $type => $modelContract) {
            $this->availableTypes[$type] = app()->make($modelContract);
        }
    }

    /**
     * Сохраняем комментарий.
     *
     * @param array $data
     * @param string $type
     * @param int $id
     *
     * @return MessageModelContract|null
     */
    public function saveMessage(array $data,
                                string $type,
                                int $id): ?MessageModelContract
    {
        if (! isset($this->availableTypes[$type])) {
            return null;
        }

        $usersService = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');

        $request = request();
        $item = $this->availableTypes[$type]::find($id);

        if (! ($item && $item->id)) {
            return null;
        }

        $data = array_merge($data, [
            'reviewable_id' => $item->id,
            'reviewable_type' => get_class($item),
            'user_id' => $usersService->getUserId(),
            'name' => $usersService->getUserName($request),
            'email' => $usersService->getUserEmail($request),
        ]);

        $message = $this->saveModel($data);

        if ($message && $message->id) {
            event(app()->makeWith('InetStudio\Reviews\Messages\Contracts\Events\Front\SendMessageEventContract', [
                'object' => $message,
            ]));
        }

        return $message;
    }

    /**
     * Получаем дерево комментариев по типу и id материала.
     *
     * @param string $type
     * @param int $id
     *
     * @return Collection
     */
    public function getMessagesByTypeAndId(string $type, int $id): Collection
    {
        if (! isset($this->availableTypes[$type])) {
            return collect([]);
        }

        $item = $this->availableTypes[$type]::find($id);

        if (! ($item && $item->id)) {
            return collect([]);
        }

        return $item->reviews;
    }
}
