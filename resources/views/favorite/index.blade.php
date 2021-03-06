@extends('layouts.app')
@section('title', $title = __('messages.main.favorite'))
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/changeComplexity.js"></script>
    <script src="/js/startLearningSearch.js"></script>
@endpush
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.main.main') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $language->id]) }}">{{ $language->title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="b">{{ $title }}</h2>

        <h4>
{{--            У вас в избранном {{ $phrases->count() }} предложений--}}
            @lang('messages.favorite.count_lines', ['n' => $phrases->count()])
        </h4>
        <h6>
{{--            В данном разделе отображаются только те предложения, которые входят в язык по умолчанию--}}
            @lang('messages.favorite.display_default'). @if($languageDefault)
{{--                У вас назначен язык по умолчанию--}}
                @lang('messages.favorite.you_have_default')
                : <b>{{ $languageDefault->title }}</b>
            @else
{{--                У вас не назначен язык по умолчанию--}}
                @lang('messages.favorite.you_dont_have_default')
            @endif

            @if(!$languages->isEmpty())

                <br>


                {{--            Назначение языка по умолчанию--}}
                <a href="#" type="link" class="myLink" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    @if($languageDefault)
{{--                        Вы можете изменить ваш язык по умолчанию--}}
                        @lang('messages.favorite.you_can_change')
                    @else
{{--                        Назначить язык по умолчанию--}}
                        @lang('messages.favorite.set_default_lagn')
                    @endif
                </a>
                <?php $page = 'favorite'?>
                @include('home.parts.changeDefaultLanguage')

            @else
                <h4>
{{--                    У вас нет пока ни одного изучаемого языка--}}
                    @lang('messages.home.no_any_languages')
                </h4>
                <a class="btn btn-primary mt-3" href="{{ route('language.create') }}">
{{--                    Добавить язык--}}
                    @lang('messages.home.add_language')
                </a>

            @endif
        </h6>

    @if(!$phrases->isEmpty())
        <br>
        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
{{--                Очистить избранное--}}
                @lang('messages.favorite.clear')
            </button>
            <span style="margin-left: 1em;">
{{--                Удалить все предложения из избранного (эти фразы останутся в разделах)--}}
                @lang('messages.favorite.delete_all_sentence')
            </span>
            <br><hr>
    @endif
    <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
{{--                            Очистить избранное--}}
                            @lang('messages.favorite.clear')
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="b">
{{--                            Очистить избранное--}}
                            @lang('messages.favorite.clear')
                        </h4>
                        <div>
{{--                            Здесь вы можете очистить избранное одним кликом. Фразы будут удалены из избранного, но останутся в--}}
{{--                            тех же разделах--}}
                            @lang('messages.favorite.here_can_clear')
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
{{--                            Отмена--}}
                            @lang('messages.main.cancel')
                        </button>
                        <a href="{{ route('favorite.clear', ['language_id' => $language->id]) }}" class="btn btn-primary">
{{--                            Очистить избранное--}}
                            @lang('messages.favorite.clear')
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <hr>
        <form id="form" action="" method="post">
            @csrf
        </form>

        <div class="row">
            <div class="col-lg-2">
                <div class="">
                    <label class="mb-2">
{{--                        К-во циклов--}}
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
{{--                        Задача--}}
                        {{ __('messages.sections.task') }}
                    </label>
                    <select class="form-select" name="task" id="task">
                        <option value="1" selected >
{{--                            Учить--}}
                            {{ __('messages.sections.learn') }}
                        </option>
                        <option value="2" >
{{--                            Читать--}}
                        {{ __('messages.sections.read') }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="">
                    <label class="mb-2">
{{--                        Лимит--}}
                        {{ __('messages.sections.limit') }}
                    </label>
                    <input class="form-control" name="limit" value="300" id="limit">
                </div>
            </div>

            <div class="col-lg-2 " style="margin-top:2.2em;">
                <a id="buttonChoose" href="#" class="btn btn-warning ">&nbsp;
{{--                    Учить--}}
                    {{ __('messages.sections.learn') }}!&nbsp;</a>
            </div>

        </div>


        @if(!$phrases->isEmpty())
            <br>
            <?php $num = 1?>
            @foreach($phrases as $phrase)
                <div class="" style="font-size: 1.15rem;">
                    <div class="row wordString @if(date('d-m-Y', strtotime($phrase->created_at)) ==  date('d-m-Y', time())) nowadaysPhrase @endif">
                        <div class="col-lg-1">
                            <span title="{{ $phrase->id }}">{{ $num }}</span>. &nbsp;
                            <span style="float: right">
                                <input class="inputBlock" type="checkbox" data-id="{{ $phrase->id }}" checked>
                            </span>
                        </div>
                        <div class="col-lg-5">

                            <span title="{{ $phrase->transcription }}">
                                <a href="{{ route('phrase.edit', ['phrase' => $phrase->id]) }}" class="link">
                                {{ $phrase->phrase }}
                                </a>
                            </span>
                        </div>
                        <div class="col-lg-4">
                            {{ $phrase->translate }}
                        </div>
                        <div class="col-lg-2">
                            <div style="text-align: right">
                                    <span class=""
                                          style="vertical-align: 0.25em; margin-right: 1em; color:lightblue; font-size: 0.85em;">{{ $phrase->count }} <span
                                            style="color: rgba(228,0,0,0.51);">({{$phrase->getCountReading()}})</span></span>
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
                </div>
                <?php $num++?>
            @endforeach

        @endif


    </div>
@endsection
