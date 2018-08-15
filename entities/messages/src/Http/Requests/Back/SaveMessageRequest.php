<?php

namespace InetStudio\Reviews\Messages\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveMessageRequestContract;

/**
 * Class SaveMessageRequest.
 */
class SaveMessageRequest extends FormRequest implements SaveMessageRequestContract
{
    /**
     * Определить, авторизован ли пользователь для этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'site_id.exist' => 'Поле «Сайт с отзывами» содержит несуществующее значение',
            'user_name.required' => 'Поле «Пользователь» обязательно для заполнения',
            'user_name.max' => 'Поле «Пользователь» не должно превышать 255 символов',
            'message.text.required' => 'Поле «Отзыв» обязательно для заполнения',
            'link.url' => 'Поле «Ссылка на отзыв» содержит некорректное значение',
            'user_link.url' => 'Поле «Ссылка на пользователя» содержит некорректное значение',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'site_id' => 'exists:reviews_sites,id',
            'user_name' => 'required|max:255',
            'message.text' => 'required',
            'link' => 'nullable|url',
            'user_link' => 'nullable|url',
        ];
    }
}