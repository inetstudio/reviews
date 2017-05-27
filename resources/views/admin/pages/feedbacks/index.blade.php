@extends('admin::layouts.app')

@php
    $title = 'Отзывы';
@endphp

@section('title', $title)

@section('styles')
    <!-- Sweet Alert -->
    <link href="{!! asset('admin/css/plugins/sweetalert/sweetalert.css') !!}" rel="stylesheet">
@endsection

@section('content')

    @include('admin.module.reviews::partials.breadcrumb_index', ['title' => $title])

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="{{ route('back.reviews.feedbacks.create') }}" class="btn btn-primary btn-lg">Добавить</a>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Сайт</th>
                                <th>Пользователь</th>
                                <th>Отзыв</th>
                                <th>Дата создания</th>
                                <th>Дата обновления</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($items))
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->site->name }}</td>
                                        <td>{{ $item->user }}</td>
                                        <td>{!! $item->feedback !!}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('back.reviews.feedbacks.edit', [$item->id]) }}" class="btn btn-default m-r"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btn btn-danger delete" data-url="{{ route('back.reviews.feedbacks.destroy', [$item->id]) }}"><i class="fa fa-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Sweet alert -->
    <script src="{!! asset('admin/js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

    <!-- Custom Admin Scripts -->
    <script src="{!! asset('admin/js/modules/reviews/custom.js') !!}"></script>
@endsection