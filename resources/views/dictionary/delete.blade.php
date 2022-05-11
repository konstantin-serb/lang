@extends('layouts.app')
@section('title', __('messages.dict.deleting_word'))
@section('content')
<div class="container">
    <h2 class="text-danger">
{{--        Удалить слово--}}
        {{ __('messages.dict.delete_word') }}:
    </h2>

    <h4 class="text-danger">{{ $word->word }}?</h4>

    <form action="{{ route('dictionary.destroy') }}" method="post">
        @csrf
        @method('delete')
        <input type="hidden" name="id" value="{{ $word->id }}">
        <div class="mt-3">
            <button class="btn btn-danger" type="submit">
{{--                Удалить слово--}}
                {{ __('messages.dict.delete_word') }}
            </button>
        </div>
    </form>

</div>
@endsection
