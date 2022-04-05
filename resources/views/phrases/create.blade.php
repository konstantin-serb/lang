@extends('layouts.app')
@section('title', $title = 'Добавление фраз')
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/changeComplexity.js"></script>
@endpush
@section('content')
    <form id="form" action="" method="post">
        @csrf
    </form>
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $section->language->id]) }}">{{ $section->language->title }}</a></li>
                <?= $section->getBreadcrumb($section->id)?>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('section.show', ['section' => $section->id]) }}">{{$section->title}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
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

                    <div class="col-lg-6">
                        <div class="mt-3">
                            @include('phrases.blocks.complexity')

                        </div>
                    </div>

                </div>



                <div class="btn-group mt-3">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <a class="btn btn-secondary" href="{{ route('section.show', ['section' => $section->id]) }}">
                        Вернуться в раздел
                    </a>
                </div>
                <a class="btn btn-danger mt-3" href="{{ route('phrase.deleteAll', ['section' => $section->id]) }}">
                    Удалить все фразы
                </a>
            </form>

        </div>
        <hr class="mt-4">
        @if($section->desctiption)
        <?=$section->description?>
        <hr>
        @endif
        @if(!$phrases->isEmpty())
            <?php $num = count($phrases)?>
            @foreach($phrases as $phrase)
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-1">
                            {{ $num }}
                        </div>
                        <div class="col-lg-5">
                            <span title="{{ $phrase->transcription }}">
                                <a class="myLink" href="{{ route('phrase.edit', ['phrase' => $phrase->id]) }}">
                                    {{ $phrase->phrase }}
                                </a></span>
                        </div>
                        <div class="col-lg-4">
                            {{ $phrase->translate }}
                        </div>
                        <div class="col-lg-2">
                            <div style="text-align: right" >
                                    <span class=""
                                          style="vertical-align: 0.25em; margin-right: 1em; color:lightblue; font-size: 0.85em;" >{{ $phrase->count }} <span style="color: rgba(228,0,0,0.51);">({{$phrase->getCountReading()}})</span></span>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="легкий" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="1"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-1-{{$phrase->id}}" value="option1"
                                           @if($phrase->complexity == 1) checked @endif>
                                </div>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="средний" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="2"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-2-{{$phrase->id}}" value="option2"
                                           @if($phrase->complexity == 2) checked @endif>
                                </div>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="сложный" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="3"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-3-{{$phrase->id}}" value="option3"
                                           @if($phrase->complexity == 3) checked @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: 0.1em;, margin-bottom: 0.1em; !important;">
                </div>
                <?php $num--?>
            @endforeach

        @endif


    </div>
@endsection
