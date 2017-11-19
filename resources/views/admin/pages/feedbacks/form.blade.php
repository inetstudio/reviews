@php
    $title = ($item->id) ? 'Редактирование отзыва' : 'Добавление отзыва';
@endphp

@extends('admin::layouts.app')

@section('title', $title)

@section('styles')
    <!-- SELECT2 -->
    <link href="{!! asset('admin/css/plugins/select2/select2.min.css') !!}" rel="stylesheet">

    <!-- RATEYO -->
    <link href="{!! asset('admin/css/plugins/rateyo/jquery.rateyo.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>
                {{ $title }}
            </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/back/') }}">Главная</a>
                </li>
                <li>
                    <span>Пользовательские отзывы</span>
                </li>
                <li>
                    <a href="{{ route('back.reviews.feedbacks.index') }}">Отзывы</a>
                </li>
                <li class="active">
                    <strong>
                        {{ $title }}
                    </strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">

        {!! Form::info() !!}

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        {!! Form::open(['url' => (!$item->id) ? route('back.reviews.feedbacks.store') : route('back.reviews.feedbacks.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

                            @if ($item->id)
                                {{ method_field('PUT') }}
                            @endif

                            {!! Form::hidden('feedback_id', (!$item->id) ? "" : $item->id) !!}

                            <p>Общая информация</p>

                            {!! Form::dropdown('site_id', $item->site_id, [
                                'label' => [
                                    'title' => 'Сайт с отзывами',
                                    'class' => 'col-sm-2 control-label',
                                ],
                                'field' => [
                                    'class' => 'select2 form-control',
                                    'data-placeholder' => 'Выберите сайт',
                                    'style' => 'width: 100%',
                                ],
                                'options' => [null => ''] + \InetStudio\Reviews\Models\ReviewsSiteModel::select('id', 'name')->pluck('name', 'id')->toArray(),
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

                            {!! Form::string('user', $item->user, [
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
                                    <input class="form-control" name="rating" type="hidden" id="rating" value="{{ (!$item->rating) ? 0 : $item->rating }}">
                                    <div class="rating"></div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            {!! Form::wysiwyg('feedback', $item->feedback, [
                                'label' => [
                                    'title' => 'Отзыв',
                                    'class' => 'col-sm-2 control-label',
                                ],
                                'field' => [
                                    'class' => 'tinymce',
                                ],
                            ]) !!}

                            {!! Form::buttons('', '', ['back' => 'back.reviews.feedbacks.index']) !!}

                        {!! Form::close()!!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- SELECT2 -->
    <script src="{!! asset('admin/js/plugins/select2/select2.full.min.js') !!}"></script>

    <!-- RATEYO -->
    <script src="{!! asset('admin/js/plugins/rateyo/jquery.rateyo.min.js') !!}"></script>

    <!-- TINYMCE -->
    <script src="{!! asset('admin/js/plugins/tinymce/tinymce.min.js') !!}"></script>

    <!-- CUSTOM SCRIPTS -->
    <script src="{!! asset('admin/js/modules/reviews/custom.js') !!}"></script>
@endsection
