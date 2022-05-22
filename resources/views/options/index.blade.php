@extends('layouts.app')
@section('title', $title = __('messages.options.options'))

@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.train.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        @if( session()->has('messageSuccess') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ __('messages.options.attention') }}!</strong> {{ session()->get('messageSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if( session()->has('messageSuccessEmail') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ __('messages.options.attention') }}!</strong> {{ session()->get('messageSuccessEmail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="b">{{ $title }} </h2>

        <br>

        @if(!$languages->isEmpty())

            @if($languageDefault)
                <h4>{{ __('messages.home.languageDefault') }}: {{ $languageDefault->title }}</h4>
            @else
                <h4>{{ __('messages.home.noLanguageDefault') }}</h4>
            @endif

            {{--            Назначение языка по умолчанию--}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                @if($languageDefault)
                    {{ __('messages.home.changeLanguageDefault') }}
                @else
                    {{--                        Назначить язык по умолчанию--}}
                    {{ __('messages.home.setLanguageDefault') }}
                @endif
            </button>
            <?php $page = 'options'?>
            @include('home.parts.changeDefaultLanguage')

        @else
            {{--            У вас нет пока ни одного изучаемого языка--}}
            <h4>{{ __('messages.home.no_any_languages') }}</h4>
            <a class="btn btn-primary mt-3" href="{{ route('language.create') }}">
                {{--                Добавить язык--}}
                {{ __('messages.home.add_language') }}
            </a>

        @endif
        <hr>

        <a href="{{ route('options.changePassword') }}" class="btn btn-success">
{{--            Изменить пароль--}}
            {{ __('messages.options.change_password') }}
        </a>
        <a href="{{ route('name.change') }}" class="btn btn-success">
{{--            Изменить имя--}}
            {{ __('messages.options.change_name') }}
        </a>

        <a href="{{ route('email.change') }}" class="btn btn-success">
{{--            Изменить email--}}
            {{ __('messages.options.change_email') }}
        </a>




    </div>
@endsection
