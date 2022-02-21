@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Привет {{ auth()->user()->name }}!</h2>

    <div class="mt-3">
        <a class="btn btn-secondary" href="{{ route('dictionary.enter') }}">Внести в словарь фразы</a>
    </div>

    <h2>Все слова: {{$dictionary->count()}}</h2>
    @foreach($dictionary as $word)
        <span class="">{{ $word->word }}</span> <br>
        @endforeach
</div>
@endsection
