<?php

namespace InetStudio\Reviews\Sites\Http\Requests\Back;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use InetStudio\Reviews\Sites\Contracts\Http\Requests\Back\SaveItemRequestContract;

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
            'name.required' => 'Поле «Название» обязательно для заполнения',
            'name.max' => 'Поле «Название» не должно превышать 255 символов',

            'alias.required' => 'Поле «Алиас» обязательно для заполнения',
            'alias.max' => 'Поле «Алиас» не должно превышать 255 символов',
            'alias.unique' => 'Такое значение поля «Алиас» уже существует',

            'link.url' => 'Поле «Ссылка на сайт» содержит некорректное значение',
            'link.max' => 'Поле «Ссылка на сайт» не должно превышать 1000 символов',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @param Request $request
     *
     * @return array
     */
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|max:255',
            'alias' => 'required|max:255|unique:reviews_sites,alias,'.$request->get('site_id'),
            'link' => 'url|max:1000',
        ];
    }
}
