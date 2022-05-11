@extends('layouts.app')
@section('title', $word->word)
@section('content')
<div class="container">
    <h2>{{ __('messages.dict.edit_word') }}</h2>

    <h4>{{ $word->word }}</h4>

    <div class="mt-3 btn-group">
        <a class="btn btn-danger" href="{{ route('dictionary.delete', ['word' => $word->id]) }}">
{{--            Удалить слово--}}
            {{ __('messages.dict.delete_word') }}
        </a>
        <?php $countLetterWord = iconv_strlen($word->word)?>
        @if($countLetterWord > 2)
        <a class="btn btn-success" href="{{ route('search.by_word', ['language_id' => $word->language_id,'word' => $word->word]) }}">
{{--            Фразы со словом--}}
            {{ __('messages.dict.phrases_with_the_word') }}
        </a>
        @endif
    </div>
</div>
@endsection
