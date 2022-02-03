@extends('layouts.app')
@section('title', $title = 'Добавление фраз')
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                {{--                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $language->id]) }}">{{ $language->title }}</a></li>--}}
                {{--                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>--}}
            </ol>
        </nav>
        <hr>

        <h2 class="">{{ $title }} раздела: <span class="b">{{ $section->title }}</span></h2>


        <div class="form">
            <form action="{{ route('phrase.store') }}" method="post">
                @csrf
                <input type="hidden" name="section_id" value="{{ $section->id }}">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="mb-2">Родной базовый язык</label>
                            <input class="form-control inp-text @error('translate') is-invalid @enderror" name="translate"
                                   value="{{ old('translate') }}" autocomplete="off" autofocus>
                            @error('translate')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="mb-2">{{ $section->language->title }}</label>
                            <input class="form-control inp-text @error('phrase') is-invalid @enderror" name="phrase"
                                   value="{{ old('phrase') }}" autocomplete="off">
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
                                   value="{{ old('transcription') }}" autocomplete="off" spellcheck="false">
                            @error('transcription')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="btn-group">
                    <button type="submit" class="btn btn-outline-primary">Добавить</button>
                    <a class="btn btn-outline-danger"

                       href="{{ route('section.show', ['section' => $section->id]) }}"
                    >Отмена</a>
                </div>
            </form>

        </div>
        <hr class="mt-4">
        @if(!$phrases->isEmpty())
            <?php $num = count($phrases)?>
            @foreach($phrases as $phrase)
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-1">
                            {{ $num }}
                        </div>
                        <div class="col-lg-5">
                            <span title="{{ $phrase->transcription }}">{{ $phrase->phrase }}</span>
                        </div>
                        <div class="col-lg-5">
                            {{ $phrase->translate }}
                        </div>
                    </div>
                    <hr style="margin-top: 0.1em;, margin-bottom: 0.1em; !important;">
                </div>
                <?php $num--?>
            @endforeach

        @endif


    </div>
@endsection
