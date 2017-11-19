@extends('admin::layouts.app')

@php
    $title = 'Сайты с отзывами';
@endphp

@section('title', $title)

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="{{ route('back.reviews.sites.create') }}" class="btn btn-primary btn-lg">Добавить</a>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Дата создания</th>
                                <th>Дата обновления</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($items))
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('back.reviews.sites.edit', [$item->id]) }}" class="btn btn-default m-r"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btn btn-danger delete" data-url="{{ route('back.reviews.sites.destroy', [$item->id]) }}"><i class="fa fa-times"></i></a>
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

@pushonce('scripts:reviews_custom')
    <!-- Custom Admin Scripts -->
    <script src="{!! asset('admin/js/modules/reviews/custom.js') !!}"></script>
@endpushonce
