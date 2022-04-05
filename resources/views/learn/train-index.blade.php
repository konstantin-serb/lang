@extends('layouts.app')
@section('title', $title = 'Тренировка')
@push('bottom')
{{--    <script src="/js/jquery.js"></script>--}}

@endpush
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="b">{{ $title }}</h2>
        <form id="form" action="" method="post">
            @csrf
        </form>

        <form class="mt-5" action="{{ route('learn.searchPhrase') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-lg-2">
                    <div class="">
                        <label class="mb-2">Язык</label>
                        <select class="form-select" name="language_id" id="language_id">
                            @foreach($languages as $lang)
                            <option value="{{$lang->id}}" @if($lang->id == $languageDefault->id) selected @endif>{{ $lang->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="">
                        <label class="mb-2">Выборка</label>
                        <select class="form-select" name="order" id="order">
                            <option value="1">Минимум повторено</option>
                            <option value="2">Максимум повторено</option>
                            <option value="3">Последние</option>
                            <option value="4">Первые</option>
                            <option value="5">Случайные</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="">
                        <label class="mb-2">Уровень сложности</label>
                        <select class="form-select" name="complexity" id="complexity">
                            <option value="1">Все</option>
                            <option value="2">Легкий</option>
                            <option value="3">Средний</option>
                            <option value="4">Сложный</option>
                            <option value="5">Сложный и средний</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="">
                        <label class="mb-2">Задача</label>
                        <select class="form-select" name="task">
                            <option value="1" selected>Учить</option>
                            <option value="2">Читать</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-1">
                    <div class="">
                        <label class="mb-2">Количество</label>
                        <input class="form-control" name="count" value="40">
                    </div>
                </div>

                <div class="col-lg-1">
                    <div class="">
                        <label class="mb-2">Смещение</label>
                        <input class="form-control" name="offset" value="0">
                    </div>
                </div>

                <div class="col-lg-2 " style="margin-top:2.2em;">
                    <button type="submit" class="btn btn-warning ">&nbsp;Найти&nbsp;</button>
                </div>

            </div>
        </form>


    </div>
@endsection
