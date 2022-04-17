<?php

use App\Models\Dictionary;

if(isset($section) || isset($language)) {
    if(isset($language)) {
        $language_id = $language->id;
    } else {
        if(isset($section)) {
            $language_id = $section->language_id;
        }
    }
}

if(isset($language_id)) {
    $countWords = Dictionary::getAllForLanguage($language_id);
}




if(!auth()->guest()) {
    $phrases = \App\Models\phrases\Phrase::getModel();
    $count = $phrases->where('user_id', auth()->id())->count();

    $options = \App\Models\Options::getOptions();
    if($options) {
        $languageDefault = \App\Models\Language::getOne($options->default_language_id);
    }
}



?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    @stack('top')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="
                    @auth
                        {{ route('home') }}
                    @else
                        {{ url('/') }}
                    @endauth
                    ">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('language.index') }}">Языки</a>
                            </li>
                            @if($count > 100)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('train.index') }}">Тренировка</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('statistic') }}">Статистика</a>
                            </li>
                            @endif
                        @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(isset($language_id))
                                <li class="nav-item" style="padding-bottom: 0.5rem; padding-top: 0.5rem;">Словарный запас: <span class="b">
                                        <a class="link" href="{{ route('dictionary', ['language_id' => $language_id]) }}" target="_blank" >
                            <?php
                                            if(isset(\App\Models\Statistics::getStatisticOne($language_id, date('Y-m-d', time()))->words)) {
                                                $countToday = \App\Models\Statistics::getStatisticOne($language_id, date('Y-m-d', time()))->words;
                                            } else {
                                                $countToday = 0;
                                            }

                                            $countWords = \App\Models\Statistics::getStatisticTotal($language_id)->sum('words');
                                            ?>

                                        {{ $countWords }}
                                                @if($countToday > 0)
                                    (<span style="{{ \App\Models\Statistics::getColor($countToday) }}">{{ $countToday }}</span>)
                                                    @endif
                                        </a>
                                    </span> слов</li>&nbsp;&nbsp;&nbsp;
                            @endif

                                @if(isset($language_id) && \App\Models\Statistics::getCreatedToday($language_id) > 0 )
                                    <li class="nav-item" style="padding-bottom: 0.5rem; padding-top: 0.5rem; padding-right: 1em;">
                                <span>Сегодня добавлено: <span class="b" style="{{ \App\Models\Statistics::getColor(\App\Models\Statistics::getCreatedToday($language_id)) }}">{{ \App\Models\Statistics::getCreatedToday($language_id) }}</span>
                                    </li>
                                @endif

                                @if(isset($language_id) && \App\Models\Statistics::getRepeatedToday($language_id) > 0)
                                    <li class="nav-item" style="padding-bottom: 0.5rem; padding-top: 0.5rem; padding-right: 1em;">
                                    Повторено: <span class="b"
                                        style="{{ \App\Models\Statistics::getColor(\App\Models\Statistics::getRepeatedToday($language_id)) }}">{{ \App\Models\Statistics::getRepeatedToday($language_id) }}</span>
                                    </li>
                                @endif
                                @if(isset($language_id) && \App\Models\Statistics::getReadToday($language_id) > 0)
                                    <li class="nav-item" style="padding-bottom: 0.5rem; padding-top: 0.5rem; padding-right: 1em;" >
                                    Прочитано: <span class="b"
                                        style="{{ \App\Models\Statistics::getColor(\App\Models\Statistics::getReadToday($language_id)) }}">{{ \App\Models\Statistics::getReadToday($language_id) }}</span>&nbsp;
                                    </li>
                                @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')

        </main>
    </div>


    <footer class="mt-4 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
{{--                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>--}}
{{--                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>--}}
{{--                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>--}}
                    </ul>
                </div>

                <div class="col-2">

                </div>

                <div class="col-2">

                </div>

                <?php if(isset($language)) {
                    $languageDefault = $language;
                }?>

                @if(isset($languageDefault) && $languageDefault)
                <div class="col-4 offset-1">

                        <h5>Поиск</h5>
                        <p>Заполните форму и нажмите Найти</p>
                        <form action="{{ route('search.by_phrase') }}" method="get">

                        <div class="d-flex w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Введите текст</label>
                            <input type="hidden" name="language_id" value="<?=$languageDefault->id?>">
                            <input id="newsletter1" name="word" type="text" class="form-control" placeholder="Текст">

                            <button class="btn btn-primary" type="submit">Найти</button>

                        </div>
                            <div class="mt-2">
                            <span>Язык поиска: {{ $languageDefault->title }}</span>
                            </div>
                        </form>

                </div>
                @endif
            </div>

            <div class="d-flex justify-content-between py-4 my-4 border-top" style="margin-bottom: 0 !important;">
                <p>&copy; <?php echo date('Y', time());?>
                    <a href="https://i-des.net" class="link">
                    i-des.net
                    </a>
                    All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
                </ul>
            </div>
        </div>
    </footer>
    @stack('bottom')




</body>
</html>
