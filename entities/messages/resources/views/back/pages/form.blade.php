@inject('sitesService', 'InetStudio\Reviews\Sites\Contracts\Services\Back\SitesServiceContract')

@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Редактирование сообщения' : 'Создание сообщения';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.reviews.messages::back.partials.breadcrumbs.form')
    @endpush

    <div class="row m-sm">
        <a class="btn btn-white" href="{{ route('back.reviews.messages.index') }}">
            <i class="fa fa-arrow-left"></i> Вернуться назад
        </a>
    </div>

    <div class="wrapper wrapper-content">
        {!! Form::info() !!}

        {!! Form::open(['url' => (! $item->id) ? route('back.reviews.messages.store') : route('back.reviews.messages.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

            @if ($item->id)
                {{ method_field('PUT') }}
            @endif

            {!! Form::hidden('message_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}

            {!! Form::hidden('message_type', get_class($item), ['id' => 'object-type']) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-group float-e-margins" id="mainAccordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain" aria-expanded="true">Основная информация</a>
                                </h5>
                            </div>
                            <div id="collapseMain" class="panel-collapse collapse in" aria-expanded="true">
                                <div class="panel-body">

                                    {!! Form::dropdown('site_id', $item->site_id, [
                                        'label' => [
                                            'title' => 'Сайт с отзывами',
                                            'class' => 'col-sm-2 control-label',
                                        ],
                                        'field' => [
                                            'class' => 'select2 form-control',
                                            'data-placeholder' => 'Выберите сайт',
                                            'style' => 'width: 100%',
                                            'data-source' => route('back.reviews.sites.getSuggestions'),
                                        ],
                                        'options' => [
                                            'values' => (old('site_id') ?? $item->site_id) ? $sitesService->getItemByID(old('site_id') ?? $item->site_id)->pluck('name', 'id')->toArray() : [],
                                        ],
                                    ]) !!}

                                    {!! Form::string('title', $item->title, [
                                        'label' => [
                                            'title' => 'Заголовок',
                                            'class' => 'col-sm-2 control-label',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                        ],
                                    ]) !!}

                                    {!! Form::string('user_name', $item->user_name, [
                                        'label' => [
                                            'title' => 'Пользователь',
                                            'class' => 'col-sm-2 control-label',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                        ],
                                    ]) !!}

                                    {!! Form::string('user_link', $item->user_link, [
                                        'label' => [
                                            'title' => 'Ссылка на пользователя',
                                            'class' => 'col-sm-2 control-label',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                        ],
                                    ]) !!}

                                    {!! Form::string('link', $item->link, [
                                        'label' => [
                                            'title' => 'Ссылка на отзыв',
                                            'class' => 'col-sm-2 control-label',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                        ],
                                    ]) !!}

                                    <div class="form-group ">
                                        <label for="rating" class="col-sm-2 control-label">Рейтинг</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="rating" type="hidden" id="rating" value="{{ (! $item->rating) ? 0 : $item->rating }}">
                                            <div class="rating"></div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    {!! Form::wysiwyg('message', $item->message, [
                                        'label' => [
                                            'title' => 'Отзыв',
                                        ],
                                        'field' => [
                                            'class' => 'tinymce-simple',
                                            'id' => 'content',
                                            'hasImages' => false,
                                        ],
                                    ]) !!}

                                    {!! Form::radios('is_active', (! $item->id) ? 1 : $item->is_active, [
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::buttons('', '', ['back' => 'back.reviews.messages.index']) !!}

        {!! Form::close()!!}
    </div>
@endsection
