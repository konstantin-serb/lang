@extends('layouts.app')
@section('title', $title = 'Удаление фразы')
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $phrase->section->language->id]) }}">{{ $phrase->section->language->title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="">{{ $title }}</h2>
        <br>

        <h4>Вы уверены, что хотите удалить фразу: <span class="b">{{ $phrase->phrase }}</span> ({{ $phrase->translate }})</h4>

        <br><br>
        <div class="form">
            <form action="{{ route('phrase.destroy', ['phrase' => $phrase->id]) }}" method="post">
                @csrf
                @method('delete')

                <div class="btn-group">
                    <button type="submit" class="btn btn-danger">Удалить</button>

                    <a class="btn btn-secondary" href="{{ route('phrase.create.phrase', ['section' => $phrase->section->id]) }}">
                        Отмена
                    </a>
                </div>
            </form>

        </div>



    </div>
@endsection
