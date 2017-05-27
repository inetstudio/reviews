<?php

namespace InetStudio\Reviews\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveReviewsFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'site_id.integer' => 'Поле «Сайт с отзывами» должно быть числом',
            'site_id.exists' => 'Такое значение поля «Сайт с отзывами» не существует',
            'title.max' => 'Поле «Заголовок» не должно превышать 255 символов',
            'user.max' => 'Поле «Название» не должно превышать 255 символов',
            'link.max' => 'Поле «Ссылка на отзыв» не должно превышать 1000 символов',
            'rating.integer' => 'Поле «Рейтинг» должно быть числом',
            'feedback.required' => 'Поле «Отзыв» обязательно для заполнения',
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
            'site_id' => 'nullable|integer|exists:reviews_sites,id',
            'title' => 'max:255',
            'user' => 'max:255',
            'link' => 'max:1000',
            'rating' => 'integer',
            'feedback' => 'required',
        ];
    }
}
