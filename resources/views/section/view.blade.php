@extends('layouts.app')
@section('title', $title = $section->title)
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $section->language->id]) }}">{{ $section->language->title }}</a></li>
                <?= $section->getBreadcrumb($section->id)?>

                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="b">{{ $title }}</h2>

        <div class="mt-3 btn-group">
            <a href="{{ route('section.create.sec', ['section' => $section->id, 'language' => $section->language->id]) }}" class="btn btn-outline-secondary">
                Добавить раздел</a>
            <a class="btn btn-outline-success" href="{{ route('section.edit', ['section' => $section->id]) }}">Редактировать</a>
        </div>

        @if(!$section->sections->isEmpty())
            <div class="mt-3">
                <h3 class="b">Разделы:</h3>

                <div class="mt-2">
                    @foreach($section->sections as $section)
                        <a href="{{ route('section.show', ['section' => $section->id]) }}" class="h5 b no-effect">{{ $section->title }}</a> <br>

                    @endforeach
                </div>
            </div>
        @endif

        <div class="row">

        </div>


    </div>
@endsection
