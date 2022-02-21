@extends('layouts.app')
@section('title', $word->word)
@section('content')
<div class="container">
    <h2>Редактировать слово</h2>

    <h4>{{ $word->word }}</h4>

    <div class="mt-3">
        <a class="btn btn-danger" href="{{ route('dictionary.delete', ['word' => $word->id]) }}">Удалить слово</a>
    </div>
</div>
@endsection
