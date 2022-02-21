@extends('layouts.app')
@section('title', 'Удаление слова')
@section('content')
<div class="container">
    <h2 class="text-danger">Удалить слово:</h2>

    <h4 class="text-danger">{{ $word->word }}?</h4>

    <form action="{{ route('dictionary.destroy') }}" method="post">
        @csrf
        @method('delete')
        <input type="hidden" name="id" value="{{ $word->id }}">
        <div class="mt-3">
            <button class="btn btn-danger" type="submit">Удалить слово</button>
        </div>
    </form>

</div>
@endsection
