@inject('sitesService', 'InetStudio\Reviews\Sites\Contracts\Services\Back\ItemsServiceContract')

@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Редактирование сообщения' : 'Создание сообщения';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.reviews.messages::back.partials.breadcrumbs.form')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <a class="btn btn-sm btn-white" href="{{ route('back.reviews.messages.index') }}">
                    <i class="fa fa-arrow-left"></i> Вернуться назад
                </a>
            </div>
        </div>

        {!! Form::info() !!}

        {!! Form::open(['url' => (! $item->id) ? route('back.reviews.messages.store') : route('back.reviews.messages.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data']) !!}

        @if ($item->id)
            {{ method_field('PUT') }}
        @endif

        {!! Form::hidden('message_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}

        {!! Form::hidden('message_type', get_class($item), ['id' => 'object-type']) !!}

        <div class="ibox">
            <div class="ibox-title">
                {!! Form::buttons('', '', ['back' => 'back.reviews.messages.index']) !!}
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel-group float-e-margins" id="mainAccordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain"
                                           aria-expanded="true">Основная информация</a>
                                    </h5>
                                </div>
                                <div id="collapseMain" class="collapse show" aria-expanded="true">
                                    <div class="panel-body">

                                        <div class="form-group row ">
                                            <label for="ean"
                                                   class="col-sm-2 col-form-label font-bold font-bold">Медиа</label>
                                            <div class="col-sm-10">
                                                <div class="product-image">
                                                    @include('admin.module.reviews.messages::back.partials.preview', [
                                                        'item' => $item,
                                                        'conversion' => 'index'
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        {!! Form::dropdown('site_id', $item->site_id, [
                                            'label' => [
                                                'title' => 'Сайт с отзывами',
                                            ],
                                            'field' => [
                                                'class' => 'select2-drop form-control',
                                                'data-placeholder' => 'Выберите сайт',
                                                'style' => 'width: 100%',
                                                'data-source' => route('back.reviews.sites.getSuggestions'),
                                            ],
                                            'options' => [
                                                'values' => (old('site_id') ?? $item->site_id) ? $sitesService->getItemById(old('site_id') ?? $item->site_id)->pluck('name', 'id')->toArray() : [],
                                            ],
                                        ]) !!}

                                        {!! Form::string('title', $item->title, [
                                            'label' => [
                                                'title' => 'Заголовок',
                                            ],
                                        ]) !!}

                                        {!! Form::string('name', $item->name, [
                                            'label' => [
                                                'title' => 'Пользователь',
                                            ],
                                        ]) !!}

                                        {!! Form::string('email', $item->email, [
                                            'label' => [
                                                'title' => 'Email',
                                            ],
                                        ]) !!}

                                        {!! Form::string('user_link', $item->user_link, [
                                            'label' => [
                                                'title' => 'Ссылка на пользователя',
                                            ],
                                        ]) !!}

                                        {!! Form::string('link', $item->link, [
                                            'label' => [
                                                'title' => 'Ссылка на отзыв',
                                            ],
                                        ]) !!}

                                        <div class="form-group row">
                                            <label for="rating"
                                                   class="col-sm-2 col-form-label font-bold">Рейтинг</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="rating" type="hidden" id="rating"
                                                       value="{{ (! $item->rating) ? 0 : $item->rating }}">
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
            </div>
            <div class="ibox-footer">
                {!! Form::buttons('', '', ['back' => 'back.reviews.messages.index']) !!}
            </div>
        </div>

        {!! Form::close()!!}
    </div>
@endsection
