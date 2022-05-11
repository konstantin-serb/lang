@extends('layouts.app')
@section('title', $title = __('messages.phrases.phrase_editing'))
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/addToFavorite.js"></script>
@endpush
@section('content')
    <div class="container">
        <form id="form" action="" method="post">
            @csrf
        </form>

        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $phrase->section->language->id]) }}">{{ $phrase->section->language->title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="">{{ $title }}</h2>
        <br>
        <a class="btn btn-secondary" href="{{ route('phrase.create.phrase', ['section' => $phrase->section->id]) }}">
{{--            Вернуться в раздел--}}
            {{ __('messages.phrases.back_section') }}
        </a>

        <div class="form">
            <form action="{{ route('phrase.update', ['phrase' => $phrase->id]) }}" method="post">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="mb-2">
{{--                                Родной базовый язык--}}
                                {{ __('messages.phrases.native_language') }}
                            </label>
                            <input class="form-control inp-text @error('translate') is-invalid @enderror" name="translate"
                                   value="{{ old('translate', $phrase->translate) }}" autocomplete="off">
                            @error('translate')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="mb-2">{{ $phrase->section->language->title }}</label>
                            <input class="form-control inp-text @error('phrase') is-invalid @enderror" name="phrase"
                                   value="{{ old('phrase', $phrase->phrase) }}" autocomplete="off">
                            @error('phrase')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="mb-2">
{{--                                Транскрипция--}}
                                {{ __('messages.phrases.transcription') }}
                            </label>
                            <input class="form-control inp-text @error('transcription') is-invalid @enderror"
                                   name="transcription"
                                   value="{{ old('transcription', $phrase->transcription) }}" autocomplete="off" spellcheck="false">
                            @error('transcription')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="mt-3">
                            <label class="mb-2">
{{--                                Уровень сложности--}}
                                {{ __('messages.sections.diff_level') }}
                            </label>
                            <select class="form-select inp-text "
                                    name="complexity" autocomplete="off" spellcheck="false">
                                <option value="1" @if($phrase->complexity == 1) selected @endif>
{{--                                    Легкий--}}
                                    {{ __('messages.sections.easy') }}
                                </option>
                                <option value="2" @if($phrase->complexity == 2) selected @endif>
{{--                                    Средний--}}
                                    {{ __('messages.sections.medium') }}
                                </option>
                                <option value="3" @if($phrase->complexity == 3) selected @endif>
{{--                                    Сложный--}}
                                    {{ __('messages.sections.hard') }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-1">
                        <div class="mt-3">
                            <label class="mb-2">
{{--                                Избранное--}}
                                {{ __('messages.main.favorite') }}
                            </label>
                            <span class="favorite-{{ $phrase->id }}">
                            <input class="form-check favorite" type="checkbox" data-id="{{ $phrase->id }}"
                                   @if($phrase->type == 1)
                                   checked
                                   @endif
                            >

                            </span>
                        </div>
                    </div>
                </div>

{{--                <hr>--}}
                <div class="mt-4 mb-3">
                    <h5 class="b mb-3">
{{--                        Основные сведения--}}
                        {{ __('messages.phrases.basis_information') }}:</h5>
                    <div class="row">
                        <div class="col-lg-2">
{{--                            Добавлено--}}
                            {{ __('messages.phrases.added') }}: </div><div class="col-lg-2"><b>{{ $phrase->created_at }}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
{{--                            Изменено (училось)--}}
                            {{ __('messages.phrases.changed') }}: </div><div class="col-lg-2"><b>{{ $phrase->updated_at }}</b></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-2">
{{--                            Повторено раз--}}
                            {{ __('messages.phrases.repeated') }}: </div><div class="col-lg-2"><b>{{ $phrase->getCountLearning() }}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
{{--                            Прочитано раз--}}
                            {{ __('messages.phrases.read') }}: </div><div class="col-lg-2"><b>{{ $phrase->getCountReading() }}</b></div>
                    </div>
                </div>


                <div class="btn-group mt-3">
                    <button type="submit" class="btn btn-primary">
{{--                        Изменить--}}
                        {{ __('messages.main.change') }}
                    </button>

                    <a class="btn btn-danger" href="{{ route('phrase.delete', ['phrase' => $phrase->id]) }}">
{{--                        Удалить--}}
                        {{ __('messages.main.delete') }}
                    </a>
                </div>
            </form>

        </div>



    </div>
@endsection
