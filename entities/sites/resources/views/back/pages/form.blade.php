@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Редактирование сайта с отзывами' : 'Добавление сайта с отзывами';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.reviews.sites::back.partials.breadcrumbs.form')
    @endpush

    <div class="row m-sm">
        <a class="btn btn-white" href="{{ route('back.reviews.sites.index') }}">
            <i class="fa fa-arrow-left"></i> Вернуться назад
        </a>
    </div>

    <div class="wrapper wrapper-content">
        {!! Form::info() !!}

        {!! Form::open(['url' => (! $item->id) ? route('back.reviews.sites.store') : route('back.reviews.sites.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

            @if ($item->id)
                {{ method_field('PUT') }}
            @endif
    
            {!! Form::hidden('site_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}

            {!! Form::hidden('site_type', get_class($item), ['id' => 'object-type']) !!}
    
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

                                    {!! Form::string('name', $item->name, [
                                        'label' => [
                                            'title' => 'Название',
                                            'class' => 'col-sm-2 control-label',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                        ],
                                    ]) !!}

                                    {!! Form::string('alias', $item->alias, [
                                        'label' => [
                                            'title' => 'alias',
                                            'class' => 'col-sm-2 control-label',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                        ],
                                    ]) !!}

                                    {!! Form::string('link', $item->link, [
                                        'label' => [
                                            'title' => 'Ссылка на сайт',
                                            'class' => 'col-sm-2 control-label',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                        ],
                                    ]) !!}
    
                                    @php
                                        $previewImageMedia = $item->getFirstMedia('logo');
                                    @endphp
    
                                    {!! Form::crop('logo', $previewImageMedia, [
                                        'label' => [
                                            'title' => 'Логотип',
                                        ],
                                        'image' => [
                                            'filepath' => isset($previewImageMedia) ? url($previewImageMedia->getUrl()) : '',
                                            'filename' => isset($previewImageMedia) ? $previewImageMedia->file_name : '',
                                        ],
                                        'additional' => [
                                            [
                                                'title' => 'Описание',
                                                'name' => 'description',
                                                'value' => isset($previewImageMedia) ? $previewImageMedia->getCustomProperty('description') : '',
                                            ],
                                            [
                                                'title' => 'Copyright',
                                                'name' => 'copyright',
                                                'value' => isset($previewImageMedia) ? $previewImageMedia->getCustomProperty('copyright') : '',
                                            ],
                                            [
                                                'title' => 'Alt',
                                                'name' => 'alt',
                                                'value' => isset($previewImageMedia) ? $previewImageMedia->getCustomProperty('alt') : '',
                                            ],
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
    
            {!! Form::buttons('', '', ['back' => 'back.reviews.sites.index']) !!}

        {!! Form::close()!!}
    </div>
@endsection