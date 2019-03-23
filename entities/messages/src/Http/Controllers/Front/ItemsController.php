<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\GetItemsResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Front\SendItemResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front\ItemsControllerContract;

/**
 * Class ItemsController.
 */
class ItemsController extends Controller implements ItemsControllerContract
{
    /**
     * Отправка отзыва.
     *
     * @param ItemsServiceContract $messagesService
     * @param Request $request
     * @param string $type
     * @param string $id
     *
     * @return SendItemResponseContract
     */
    public function sendMessage(ItemsServiceContract $messagesService,
                                Request $request,
                                string $type,
                                string $id): SendItemResponseContract
    {
        $rules = [
            'message' => 'required',
            'rating' => 'required',
        ];

        if (! auth()->user()) {
            $rules = array_merge($rules, [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'g-recaptcha-response' => [
                    'required',
                    new CaptchaRule,
                ],
            ]);
        }

        Validator::make($request->all(), $rules, [
            'message.required' => 'Поле «Сообщение» обязательно для заполнения',
            'rating.required' => 'Поле «Рейтинг» обязательно для заполнения',
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',
            'email.required' => 'Поле «Email» обязательно для заполнения',
            'email.max' => 'Поле «Email» не должно превышать 255 символов',
            'email.email' => 'Поле «Email» должно содержать значение в корректном формате',
            'g-recaptcha-response.required' => 'Поле «Капча» обязательно для заполнения',
            'g-recaptcha-response.captcha'  => 'Неверный код капча',
        ])->validate();

        $data = $request->all();

        $item = $messagesService->saveMessage($data, $type, $id);

        $result = ($item && isset($item->id));

        return $this->app->make(SendItemResponseContract::class, compact('result'));
    }

    /**
     * Получаем отзывы к материалу.
     *
     * @param ItemsServiceContract $messagesService
     * @param Request $request
     * @param string $type
     * @param string $id
     *
     * @return GetItemsResponseContract
     */
    public function getMessages(ItemsServiceContract $messagesService,
                                Request $request,
                                string $type,
                                string $id): GetItemsResponseContract
    {
        $page = ($request->filled('page')) ? $request->get('page') - 1 : 0;
        $limit = ($request->filled('limit')) ? $request->get('limit') : 3;

        $items = $messagesService->getMessagesByTypeAndId($type, $id)->sortByDesc('datetime');

        return $this->app->make(GetItemsResponseContract::class, [
            'data' => [
                'messages' => [
                    'stop' => (($page + 1) * $limit >= $items->count()),
                    'items' => $items->slice($page * $limit, $limit),
                ],
            ]
        ]);
    }
}
