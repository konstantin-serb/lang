@extends('layouts.app')
@section('title', 'Языки')
@section('content')
    <div class="container">
        <h2 class="b">Языки</h2>

        <div>
            <a href="{{ route('language.create') }}" class="btn btn-outline-secondary">Добавить язык</a>
        </div>

        <div class="mt-4 mb-3">
            <h3 class="b">Изучаемые языки:</h3>
        </div>

        @foreach($languages as $language)

            <div class="">
                <a class="h5 b no-effect" href="{{ route('language.show', ['language' => $language->id]) }}">{{ $language->title }}</a>
            </div>

            @endforeach
    </div>
@endsection
