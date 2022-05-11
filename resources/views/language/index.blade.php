@extends('layouts.app')
@section('title', __('messages.main.languages'))
@section('content')


    <div class="" style="margin-top:-1.6em;">
        @if(!$statistics->isEmpty())
            @include('home.parts.success-today')
        @endif
    </div>

    <div class="container">
        @if($statistics->isEmpty())
            <br><br>
        @endif
        <h2 class="b">
{{--            Языки--}}{{ __('messages.main.languages') }}
        </h2>

        <div>
            <a href="{{ route('language.create') }}" class="btn btn-primary mt-3">
{{--                Добавить язык--}}
                {{ __('messages.languages.add_language') }}
            </a>
        </div>

        @if(!$languages->isEmpty())
            <div class="mt-4 mb-3">
                <h3 class="b">
{{--                    Изучаемые языки--}}
                    {{ __('messages.languages.lang_studies') }}:
                </h3>
            </div>

            @foreach($languages as $lang)

                <div class="">
                    <a class="h5 b no-effect"
                       href="{{ route('language.show', ['language' => $lang->id]) }}">{{ $lang->title }}</a>
                </div>

            @endforeach

        @endif

    </div>
@endsection
