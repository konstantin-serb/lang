@extends('layouts.app')
@section('title', $title = __('messages.dict.search_by_word').': ' . $word)
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/changeComplexity.js"></script>
    <script src="/js/startLearning.js"></script>
@endpush
@section('content')
    <div class="container">


        <form id="form" action="" method="post">
            @csrf
        </form>

        <h2 class="b">{{ $title }} ({{ count($phrases) }})</h2>
        <a class="btn btn-success" href="javascript:history.back()">
{{--            Назад--}}
            {{ __('messages.dict.back') }}
        </a>

        <hr>
        <input type="hidden" id="word" value="{{ $word }}">

        <div class="row">
            <div class="col-lg-2">
                <div class="">
                    <label class="mb-2">
                        {{--                            К-во циклов--}}
                        {{ __('messages.sections.count_cycles') }}
                    </label>
                    <select class="form-select" name="cycles" id="countCycles">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="">
                    <label class="mb-2">
                        {{--                            Уровень сложности--}}
                        {{ __('messages.sections.diff_level') }}
                    </label>
                    <select class="form-select" name="complexity" id="complexity">
                        <option value="1">
                            {{--                                Все--}}
                            {{ __('messages.sections.all') }}
                        </option>
                        <option value="2">
                            {{--                                Легкий--}}
                            {{ __('messages.sections.easy') }}
                        </option>
                        <option value="3">
                            {{--                                Средний--}}
                            {{ __('messages.sections.medium') }}
                        </option>
                        <option value="4">
                            {{--                                Сложный--}}
                            {{ __('messages.sections.hard') }}
                        </option>
                        <option value="5">
                            {{--                                Сложный и средний--}}
                            {{ __('messages.sections.medium_and_hard') }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="">
                    <label class="mb-2">
{{--                        Сортировка--}}
                        {{ __('messages.sections.sorting') }}
                    </label>
                    <select class="form-select" name="sort" id="sort">
                        <option value="1">
{{--                            По порядку--}}
                            {{ __('messages.sections.in_order') }}
                        </option>
                        <option value="2" selected>
{{--                            Случайно--}}
                            {{ __('messages.sections.by_chance') }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-lg-1">
                <div class="">
                    <label class="mb-2">
{{--                        Задача--}}
                        {{ __('messages.sections.task') }}
                    </label>
                    <select class="form-select" name="task" id="task">
                        <option value="1" selected>
{{--                            Учить--}}
                            {{ __('messages.sections.learn') }}
                        </option>
                        <option value="2">
{{--                            Читать--}}
                            {{ __('messages.sections.read') }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-lg-1">
                <div class="">
                    <label class="mb-2">
{{--                        Лимит--}}
                        {{ __('messages.sections.limit') }}
                    </label>
                    <input class="form-control" name="limit" value="200" id="limit">
                </div>
            </div>

            <div class="col-lg-2 " style="margin-top:2.2em;">
                <a id="buttonChoose" href="#" class="btn btn-warning ">&nbsp;
{{--                    Учить--}}
                    {{ __('messages.sections.learn') }}!&nbsp;</a>
            </div>

        </div>

        <br>

        @if(!$phrases->isEmpty())
            <?php $num = 1?>
            @foreach($phrases as $phrase)
                <div class="" style="font-size: 1.15rem;">
                    <div class="row wordString @if(date('d-m-Y', strtotime($phrase->created_at)) ==  date('d-m-Y', time())) nowadaysPhrase @endif">
                        <div class="col-lg-1">
                            <span title="{{ $phrase->id }}">{{ $num }}</span>. &nbsp;
                            <span style="float: right" >
                                <input class="inputBlock"  type="checkbox" data-id="{{ $phrase->id }}" checked>
                            </span>
                        </div>
                        <div class="col-lg-5">

                            <span title="{{ $phrase->translate }}">
                                <a href="{{ route('phrase.edit', ['phrase' => $phrase->id]) }}" class="link">
                                <?=$phrase->addBTags($phrase->phrase, $word)?>
                                </a>
                            </span>
                        </div>
                        <div class="col-lg-4" style="font-size: 0.8em; font-weight: bold;">
                            <a class="link" href="{{ route('section.show', ['section' => $phrase->section->id]) }}">
                                {{ $phrase->section->title }}
                            </a>

                            @if(isset($phrase->section->parent))
                                >
                                <a class="link"
                                   href="{{ route('section.show', ['section' => $phrase->section->parent->id]) }}">
                                    {{ $phrase->section->parent->title }}
                                </a>
                            @endif

                            @if(isset($phrase->section->parent->parent))
                                >
                                <a class="link"
                                   href="{{ route('section.show', ['section' => $phrase->section->parent->parent->id]) }}">
                                    {{ $phrase->section->parent->parent->title }}
                                </a>
                            @endif
                        </div>
                        <div class="col-lg-2">
                            <div style="text-align: right">
                                    <span class=""
                                          style="vertical-align: 0.25em; margin-right: 1em; color:lightblue; font-size: 0.85em;">{{ $phrase->count }} <span
                                            style="color: rgba(228,0,0,0.51);">({{$phrase->getCountReading()}})</span></span>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="{{ __('messages.sections.easy') }}" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="1"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-1-{{$phrase->id}}" value="option1"
                                           @if($phrase->complexity == 1) checked @endif>
                                </div>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="{{ __('messages.sections.medium') }}" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="2"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-2-{{$phrase->id}}" value="option2"
                                           @if($phrase->complexity == 2) checked @endif>
                                </div>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="{{ __('messages.sections.hard') }}" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="3"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-3-{{$phrase->id}}" value="option3"
                                           @if($phrase->complexity == 3) checked @endif>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php $num++?>
            @endforeach

        @endif


    </div>
@endsection
