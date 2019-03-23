<?php

namespace InetStudio\Reviews\Messages\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\Reviews\Messages\Contracts\Http\Requests\Back\SaveItemRequestContract;

/**
 * Class SaveItemRequest.
 */
class SaveItemRequest extends FormRequest implements SaveItemRequestContract
{
    /**
     * Определить, авторизован ли пользователь для этого запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'site_id.exist' => 'Поле «Сайт с отзывами» содержит несуществующее значение',
            'name.required' => 'Поле «Имя пользователя» обязательно для заполнения',
            'name.max' => 'Поле «Имя пользователя» не должно превышать 255 символов',
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
    public function rules(): array
    {
        return [
            'site_id' => 'exists:reviews_sites,id',
            'name' => 'required|max:255',
            'message.text' => 'required',
            'link' => 'nullable|url',
            'user_link' => 'nullable|url',
        ];
    }
}
