@pushonce('modals:messages')
<div id="messages_list_modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal inmodal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Закрыть</span></button>
                <h1 class="modal-title">Отзывы</h1>
            </div>

            <div class="modal-body">
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="#" class="btn btn-xs btn-primary m-b-lg add_message">Добавить</a>
                        <table class="table table-hover messages-list">
                            <tbody>
                            <tr class="message-tr-template" style="display: none">
                                <td class="message-title">
                                    <span></span>
                                </td>
                                <td width="10%">
                                    <div class="btn-nowrap">
                                        <a href="#" class="btn btn-xs btn-default edit-message m-r-xs"><i
                                                    class="fa fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs btn-danger delete-message"><i
                                                    class="fa fa-times"></i></a>
                                    </div>
                                </td>
                                <input name="message[]'" type="hidden" value="">
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                <a href="#" class="btn btn-primary save">Сохранить</a>
            </div>
        </div>
    </div>
</div>

<div id="message_modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal inmodal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Закрыть</span></button>
                <h1 class="modal-title">Создание отзыва</h1>
            </div>
            <div class="modal-body">
                <div class="ibox-content">
                    {!! Form::open(['url' => route('back.reviews.messages.store'), 'id' => 'messageModalForm', 'enctype' => 'multipart/form-data']) !!}

                    {{ method_field('POST') }}

                    {!! Form::hidden('message_id', '') !!}

                    {!! Form::dropdown('site_id', '', [
                        'label' => [
                            'title' => 'Сайт с отзывами',
                        ],
                        'field' => [
                            'class' => 'select2 form-control',
                            'data-placeholder' => 'Выберите сайт',
                            'style' => 'width: 100%',
                            'data-source' => route('back.reviews.sites.getSuggestions'),
                        ],
                        'options' => [
                            'values' => [],
                        ],
                    ]) !!}

                    {!! Form::string('title', '', [
                        'label' => [
                            'title' => 'Заголовок',
                        ],
                    ]) !!}

                    {!! Form::string('name', '', [
                        'label' => [
                            'title' => 'Имя пользователя',
                        ],
                    ]) !!}

                    {!! Form::string('email', '', [
                        'label' => [
                            'title' => 'Email пользователь',
                        ],
                    ]) !!}

                    {!! Form::string('user_link', '', [
                        'label' => [
                            'title' => 'Ссылка на пользователя',
                        ],
                    ]) !!}

                    {!! Form::string('link', '', [
                        'label' => [
                            'title' => 'Ссылка на отзыв',
                        ],
                    ]) !!}

                    <div class="form-group row">
                        <label for="rating" class="col-sm-2 col-form-label font-bold">Рейтинг</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="rating" type="hidden" id="rating" value="0">
                            <div class="rating"></div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    {!! Form::wysiwyg('message', '', [
                        'label' => [
                            'title' => 'Отзыв',
                        ],
                        'field' => [
                            'class' => 'tinymce-simple',
                            'id' => 'modal_message',
                            'hasImages' => false,
                        ],
                    ]) !!}

                    {!! Form::radios('is_active', 1, [
                        'label' => [
                            'title' => 'Отображать на сайте',
                        ],
                        'radios' => [
                            [
                                'label' => 'Да',
                                'value' => 1,
                                'options' => [
                                    'class' => 'i-checks',
                                ],
                            ],
                            [
                                'label' => 'Нет',
                                'value' => 0,
                                'options' => [
                                    'class' => 'i-checks',
                                ],
                            ]
                        ],
                    ]) !!}

                    {!! Form::close()!!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                <a href="#" class="btn btn-primary save">Сохранить</a>
            </div>
        </div>
    </div>
</div>
@endpushonce
