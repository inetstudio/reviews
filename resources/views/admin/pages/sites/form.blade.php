@php
    $title = ($item->id) ? 'Редактирование сайта с отзывами' : 'Добавление сайта с отзывами';
@endphp

@extends('admin::layouts.app')

@section('title', $title)

@pushonce('styles:reviews_custom')
    <!-- CUSTOM -->
    <link href="{!! asset('admin/css/modules/reviews/custom.css') !!}" rel="stylesheet">
@endpushonce

@section('content')
    <div class="wrapper wrapper-content">

        {!! Form::info() !!}

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        {!! Form::open(['url' => (!$item->id) ? route('back.reviews.sites.store') : route('back.reviews.sites.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

                            @if ($item->id)
                                {{ method_field('PUT') }}
                            @endif

                            {!! Form::hidden('site_id', (!$item->id) ? "" : $item->id) !!}

                            <p>Общая информация</p>

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

                            <div class="form-group ">
                                <label for="logo" class="col-sm-2 control-label">Логотип</label>
                                <div class="col-sm-10">
                                    @if ($item->hasMedia('images'))
                                        <img src="{{ $item->getFirstMediaUrl('images') }}" class="site-logo" />
                                    @endif
                                    <input class="form-control" name="logo" type="file" id="logo">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            {!! Form::buttons('', '', ['back' => 'back.reviews.sites.index']) !!}

                        {!! Form::close()!!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushonce('scripts:reviews_custom')
    <!-- Custom Admin Scripts -->
    <script src="{!! asset('admin/js/modules/reviews/custom.js') !!}"></script>
@endpushonce