@extends('layouts.app')
@section('title', $title =  __('messages.train.learn_in_word').': '. $word)
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/checkPhrase.js"></script>
    <script src="/js/changeComplexity.js"></script>
    <script src="/js/changePhrase.js"></script>
    <script src="/js/addToFavorite.js"></script>
@endpush
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $language->id]) }}">{{ $language->title }}</a></li>

            </ol>
        </nav>
        <hr>

        <h2 class="b">{{ __('messages.train.learn_in_word') }}: <span class="text-primary">{{ $word }}</span></h2>
        <form id="form" action="" method="post">
            @csrf
        </form>


        <hr>
        <span class=" h5 b">{{ __('messages.train.generate', ['count' => count($endCollection)]) }}</span>

        @if(!$endCollection == null)
            <div class="h5 mt-5">
                @foreach($endCollection as $key=>$value)
                    <div class="row mt-2" style="border-bottom:gray dashed 1px">

                        <div class="col-lg-4" >
                            <?php $type = 'learn'?>
                            @include('learn.parts.editModal')

                            <span class="translate-{{ $value->id }}" style="vertical-align: bottom" title="({{ $value->transcription }})">
                                  {{ $value->translate }}
                             </span>
                        </div>
                        <div class="col-lg-4">
                            <span id="selector{{ $key. '-' .$value->id }}"><input class="my-input" type="text" style="width: 100%; border: none" data-id="{{ $value->id }}"
                                                                                  data-num="{{ $key }}"  @if($key == 0) autofocus @endif></span>
                        </div>
                        <div class="col-lg-4" style="text-align: end">
                            <span class="clo phrase-{{ $value->id }}" style="vertical-align: 0.15em;">
                                {{ $value->phrase }}
                            </span> &nbsp;


                            <div style="text-align: right; display: inline-block">
                                <span class="count{{ $value->id }}" style="vertical-align: 0.15em; margin-right: 1em; color:lightblue">{{ $value->count }}</span>

                                @if($compl)
                                    <div class="form-check form-check-inline" style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                        <input tabindex="-1" class="form-check-input" title="{{ __('messages.sections.easy') }}" type="radio" data-id="{{ $value->id }}" data-type="1" name="inlineRadioOptions-{{ $value->id }}" id="inlineRadio-1-{{$value->id}}" value="option1" @if($value->complexity == 1) checked @endif>
                                    </div>
                                    <div class="form-check form-check-inline" style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                        <input tabindex="-1" class="form-check-input" title="{{ __('messages.sections.medium') }}" type="radio" data-id="{{ $value->id }}" data-type="2" name="inlineRadioOptions-{{ $value->id }}" id="inlineRadio-2-{{$value->id}}" value="option2" @if($value->complexity == 2) checked @endif>
                                    </div>
                                    <div class="form-check form-check-inline" style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                        <input tabindex="-1" class="form-check-input" title="{{ __('messages.sections.hard') }}" type="radio" data-id="{{ $value->id }}" data-type="3" name="inlineRadioOptions-{{ $value->id }}" id="inlineRadio-3-{{$value->id}}" value="option3" @if($value->complexity == 3) checked @endif>
                                    </div>
                                @endif

                            </div>
                        </div>

                        {{--<hr>--}}
                    </div>

                @endforeach
            </div>

        @endif


    </div>
@endsection
