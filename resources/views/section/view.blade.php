@extends('layouts.app')
@section('title', $title = $section->title)
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/changeComplexity.js"></script>
@endpush
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

        <form id="form" action="" method="post">
            @csrf

        <h2 class="b">{{ $title }}</h2>
        <p><?=$section->description?></p>

        <div class="mt-3 btn-group">
            <a href="{{ route('section.create.sec', ['section' => $section->id, 'language' => $section->language->id]) }}" class="btn btn-outline-secondary">
                Добавить раздел</a>
            <a class="btn btn-outline-success" href="{{ route('section.edit', ['section' => $section->id]) }}">Редактировать</a>
        </div>

        @if(!$section->sections->isEmpty())
            <div class="mt-3">
                <h3 class="b">Разделы:</h3>

                <div class="mt-2">
                    <?php
                    $sections = $section->sections;
                    $sections = $sections->sortBy('title');
                    ?>
                    @foreach($sections as $item)
                        <a href="{{ route('section.show', ['section' => $item->id]) }}" class="h5 b no-effect">{{ $item->title }}</a> <br>

                    @endforeach
                </div>
            </div>
        @endif

        <hr>
        <div class="btn-group">
            <a href="{{ route('phrase.create.phrase', ['section' => $section->id]) }}" class="btn btn-success">Добавить/редак. фразы</a>
            <!-- Example split danger button -->
            <div class="btn-group">
                <button type="button" class="btn btn-warning">Учить!</button>
                <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('learn', ['section' => $section->id]) }}">Простой</a></li>
                    <li><a class="dropdown-item" href="{{ route('learn', ['section' => $section->id, 'cycles' => 2]) }}">Стандартный</a></li>
                    <li><a class="dropdown-item" href="{{ route('learn', ['section' => $section->id, 'cycles' => 3]) }}">Усиленный</a></li>
                    <li><a class="dropdown-item" href="{{ route('learn', ['section' => $section->id, 'cycles' => 3, 'complexity' => 2]) }}">Средний-трудный (2)</a></li>
                    <li><a class="dropdown-item" href="{{ route('learn', ['section' => $section->id, 'cycles' => 3, 'complexity' => 3]) }}">Трудный (3)</a></li>
{{--                    <li><a class="dropdown-item" href="#">Сложные фразы</a></li>--}}
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="https://i-des.net">Сайт крутого программиста</a></li>
                </ul>
            </div>

        </div>
        <br><br>
        @if(!$phrases->isEmpty())
            <?php $num = 1?>
            @foreach($phrases as $phrase)
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-1">
                            <span title="{{ $phrase->id }}">{{ $num }}</span>
                        </div>
                        <div class="col-lg-5">
                            <span title="{{ $phrase->transcription }}">{{ $phrase->phrase }}</span>
                        </div>
                        <div class="col-lg-4">
                            {{ $phrase->translate }}
                        </div>
                        <div class="col-lg-2">
                            <div style="text-align: right">
                                <span class="" style="vertical-align: 0.15em; margin-right: 1em; color:lightblue">{{ $phrase->count }}</span>
                                <div class="form-check form-check-inline" style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="легкий" type="radio" data-id="{{ $phrase->id }}" data-type="1" name="inlineRadioOptions-{{ $phrase->id }}" id="inlineRadio-1-{{$phrase->id}}" value="option1" @if($phrase->complexity == 1) checked @endif>
                                </div>
                                <div class="form-check form-check-inline" style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="средний" type="radio" data-id="{{ $phrase->id }}" data-type="2" name="inlineRadioOptions-{{ $phrase->id }}" id="inlineRadio-2-{{$phrase->id}}" value="option2" @if($phrase->complexity == 2) checked @endif>
                                </div>
                                <div class="form-check form-check-inline" style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="сложный" type="radio" data-id="{{ $phrase->id }}" data-type="3" name="inlineRadioOptions-{{ $phrase->id }}" id="inlineRadio-3-{{$phrase->id}}" value="option3" @if($phrase->complexity == 3) checked @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: 0.1em;, margin-bottom: 0.1em; !important;">
                </div>
                <?php $num++?>
            @endforeach

        @endif


    </div>
@endsection
