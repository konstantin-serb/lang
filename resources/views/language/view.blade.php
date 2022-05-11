@extends('layouts.app')
@section('title', $title = $language->title)
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="b">{{ $title }}</h2>
        <a href="{{ route('favorite.language', ['language_id' => $language->id]) }}" class="btn btn-primary">
{{--            Посмотреть избранное--}}
            {{ __('messages.languages.view_fav') }}
        </a>

        <div class="mt-4">
            <a href="{{ route('section.create.sec', ['section' => 0, 'language' => $language->id]) }}" class="btn btn-outline-secondary">
{{--                Добавить раздел--}}
                {{ __('messages.languages.add_sec') }}
            </a>
        </div>

        @if(!$sections->isEmpty())
            <div class="mt-3">
                <h3 class="b">
{{--                    Разделы--}}
                    {{ __('messages.sections.sections') }}:</h3>

                <div class="mt-2">
                    @foreach($sections as $section)
                        <a href="{{ route('section.show', ['section' => $section->id]) }}" class="h5 b no-effect">{{ $section->title }}</a> <br>

                    @endforeach
                </div>
            </div>
        @endif

        <div class="row">

        </div>


    </div>
@endsection
