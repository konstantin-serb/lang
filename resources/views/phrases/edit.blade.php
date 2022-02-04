@extends('layouts.app')
@section('title', $title = 'Редактирование фразы')
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $phrase->section->language->id]) }}">{{ $phrase->section->language->title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="">{{ $title }}</h2>
        <br>
        <a class="btn btn-secondary" href="{{ route('phrase.create.phrase', ['section' => $phrase->section->id]) }}">
            Вернуться назад
        </a>

        <div class="form">
            <form action="{{ route('phrase.update', ['phrase' => $phrase->id]) }}" method="post">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="mb-2">Родной базовый язык</label>
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
                    </div>

                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="mb-2">Транскрипция</label>
                            <input class="form-control inp-text @error('transcription') is-invalid @enderror"
                                   name="transcription"
                                   value="{{ old('transcription', $phrase->transcription) }}" autocomplete="off" spellcheck="false">
                            @error('transcription')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Изменить</button>

                    <a class="btn btn-danger" href="{{ route('phrase.delete', ['phrase' => $phrase->id]) }}">
                        Удалить
                    </a>
                </div>
            </form>

        </div>



    </div>
@endsection
