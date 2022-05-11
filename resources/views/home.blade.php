@extends('layouts.app')
@section('title', $title = __('messages.main.main').' | languages')
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/changeComplexity.js"></script>
@endpush
@section('content')

    <form id="form" action="" method="post">
        @csrf
    </form>
    <div class="" style="margin-top:-1.6em;">
        @if(!$statistics->isEmpty())
            @include('home.parts.success-today')
        @endif
    </div>
    <div class="container">
        @if($statistics->isEmpty())
            <br>
        @endif
        <h2 class="mt-3">{{ __('messages.home.hello') }} {{ auth()->user()->name }}!</h2>



        @if(!$languages->isEmpty())

            <br>
            @if($languageDefault)
                <h4>{{ __('messages.home.languageDefault') }}: {{ $languageDefault->title }}</h4>
            @else
                <h4>{{ __('messages.home.noLanguageDefault') }}</h4>
            @endif

{{--            Назначение языка по умолчанию--}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    @if($languageDefault)
                        {{ __('messages.home.changeLanguageDefault') }}
                    @else
{{--                        Назначить язык по умолчанию--}}
                        {{ __('messages.home.setLanguageDefault') }}
                    @endif
                </button>
            <?php $page = 'home'?>
            @include('home.parts.changeDefaultLanguage')

        @else
{{--            У вас нет пока ни одного изучаемого языка--}}
            <h4>{{ __('messages.home.no_any_languages') }}</h4>
            <a class="btn btn-primary mt-3" href="{{ route('language.create') }}">
{{--                Добавить язык--}}
                {{ __('messages.home.add_language') }}
            </a>

        @endif

        @if($sectionsAdd)
            <br>
            <br>
            <hr>
            <h3 class="mb-3"><b>
{{--                    Последние добавленные разделы--}}
                    {{ __('messages.home.last_added_sections') }}:</b></h3>

            @foreach($sectionsAdd as $item)
                @include('home.cycle1')
            @endforeach
        @endif


        @if($sectionsLear)
            <br>
            <br>
            <hr>
            <h3 class="mb-3"><b>
{{--                    Последние повторенные упражнения--}}
                    {{ __('messages.home.last_repeated_sections') }}:
                </b></h3>

            @foreach($sectionsLear as $item)
                @include('home.cycle1')
            @endforeach
        @endif


        @if($sectionsRead)
            <br>
            <br>

            <h3 class="mb-3"><b>
{{--                    Последние прочитанные упражнения--}}
                    {{ __('messages.home.last_read_sections') }}:</b></h3>

            @foreach($sectionsRead as $item)
                @include('home.cycle1')
            @endforeach

            @endif

            @if($phrases)
                <br>
                <br>
            <h3 class="mb-3"><b>
{{--                    Последние добавленные фразы--}}
                    {{ __('messages.home.last_added_phrases') }}:</b></h3>
      @foreach($phrases as $phrase)
                <div class="" style="font-size: 1.1rem;">
                    <div class="row wordString @if(date('d-m-Y', $phrase->user_id) ==  date('d-m-Y', time())) nowadays @endif">
                        <div class="col-lg-2">
                            @if(date('d-m-Y', $phrase->user_id) ==  date('d-m-Y', time())) <b style="color: blue">  @endif
                            <span style="font-size: 0.8em;">{{ date('d-m-Y  H:i', $phrase->user_id) }}</span>
                                @if(date('d-m-Y', $phrase->user_id) ==  date('d-m-Y', time())) </b>  @endif
                        </div>
                        <div class="col-lg-4">
                            <a class="myLink" href="{{ route('phrase.edit', ['phrase' => $phrase->id]) }}">
                            <span title="{{ $phrase->transcription }}">{{ $phrase->phrase }}</span>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            {{ $phrase->translate }}
                        </div>
                        <div class="col-lg-2">
                            <div style="text-align: right" >

                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="{{ __('messages.main.easy') }}" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="1"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-1-{{$phrase->id}}" value="option1"
                                           @if($phrase->complexity == 1) checked @endif>
                                </div>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="{{ __('messages.main.medium') }}" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="2"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-2-{{$phrase->id}}" value="option2"
                                           @if($phrase->complexity == 2) checked @endif>
                                </div>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="{{ __('messages.main.hard') }}" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="3"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-3-{{$phrase->id}}" value="option3"
                                           @if($phrase->complexity == 3) checked @endif>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <hr style="margin-top: 0.1em;, margin-bottom: 0.1em; !important;">--}}
                </div>
                @endforeach



        @endif

    </div>
@endsection
