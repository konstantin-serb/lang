@extends('layouts.app')
@section('title', __('messages.dict.new_words_to_today'))
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/checkWord.js"></script>
@endpush

@section('content')
<div class="container">
    <h2>{{ __('messages.home.hello') }} {{ auth()->user()->name }}!</h2>

    <div class="mt-3">
        <a href="{{ route('dictionary.all', ['language_id' => $language->id]) }}" class="btn btn-success">
{{--            Весь словарный запас--}}
            {{ __('messages.dict.all_vocabulary') }}
        </a>
    </div>
    @if(!$wordsToday->isEmpty())
    <h2 class="mt-4">{{ __('messages.dict.count_new_words_today') }}: {{$wordsToday->count()}}</h2>
        @foreach($wordsToday as $word)
            <div class="row">
                <div class="col-lg-2">
                    <a href="{{ route('dictionary.view', ['word' => $word->id]) }}" class="b link">
                        <span class="" style="font-size: 1.1rem;">{{ $word->word }}</span>
                    </a>
                </div>
                <div class="col-lg-1">
                    <input type="checkbox" class="form-check checkBox" @if($word->status == 1) checked @endif data-id="{{ $word->id }}">
                </div>
            </div>
        @endforeach

    @endif


</div>
@endsection
