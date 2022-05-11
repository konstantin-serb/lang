@extends('layouts.app')
@section('title', $title = __('messages.dict.all_vocabulary'))
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/checkWord.js"></script>
@endpush
@section('content')
<div class="container">
    <h2>{{ __('messages.train.language') }}: {{ $language->title }}</h2>
    <h2 class="b">{{ $title }}: {{$dictionary->count()}} ({{ $countWordsCheck }})</h2>

    @foreach($dictionary as $word)
        <div class="row">
            <div class="col-lg-2">
                <a href="{{ route('dictionary.view', ['word' => $word->id]) }}" class=" link">
                <span class="" style="font-size: 1.1rem;">{{ $word->word }}</span>
                </a>
            </div>
            <div class="col-lg-1">
                <input type="checkbox" class="form-check checkBox" @if($word->status == 1) checked @endif data-id="{{ $word->id }}">
            </div>
        </div>
        @endforeach
</div>
@endsection
