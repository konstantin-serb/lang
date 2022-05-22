<?php

use App\Models\Dictionary;use App\Models\Options;

if (isset($section) || isset($language)) {
    if (isset($language)) {
        $language_id = $language->id;
    } else {
        if (isset($section)) {
            $language_id = $section->language_id;
        }
    }
}

if (isset($language_id)) {
    $countWords = Dictionary::getAllForLanguage($language_id);
}




if (!auth()->guest()) {
    $phrases = \App\Models\phrases\Phrase::getModel();
    $count = $phrases->where('user_id', auth()->id())->count();

    $options = \App\Models\Options::getOptions();
    if ($options) {
        $languageDefault = \App\Models\Language::getOne($options->default_language_id);
    }
}


$locale = session('locale');

if ($locale) {
    $lang = $locale;
} elseif (auth()->id()) {

    $options = \App\Models\Options::firstOrCreate(['user_id' => auth()->id()]);
    $lang = $options->lang;
} else {
    $lang = 'en';
}


$flagEn = '<g fill-rule="evenodd">
    <g stroke-width="1pt">
      <path fill="#bd3d44" d="M0 0h972.8v39.4H0zm0 78.8h972.8v39.4H0zm0 78.7h972.8V197H0zm0 78.8h972.8v39.4H0zm0 78.8h972.8v39.4H0zm0 78.7h972.8v39.4H0zm0 78.8h972.8V512H0z" transform="scale(.9375)"/>
      <path fill="#fff" d="M0 39.4h972.8v39.4H0zm0 78.8h972.8v39.3H0zm0 78.7h972.8v39.4H0zm0 78.8h972.8v39.4H0zm0 78.8h972.8v39.4H0zm0 78.7h972.8v39.4H0z" transform="scale(.9375)"/>
    </g>
    <path fill="#192f5d" d="M0 0h389.1v275.7H0z" transform="scale(.9375)"/>
    <path fill="#fff" d="M32.4 11.8L36 22.7h11.4l-9.2 6.7 3.5 11-9.3-6.8-9.2 6.7 3.5-10.9-9.3-6.7H29zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 11-9.2-6.8-9.3 6.7 3.5-10.9-9.2-6.7h11.4zm64.8 0l3.6 10.9H177l-9.2 6.7 3.5 11-9.3-6.8-9.2 6.7 3.5-10.9-9.3-6.7h11.5zm64.9 0l3.5 10.9H242l-9.3 6.7 3.6 11-9.3-6.8-9.3 6.7 3.6-10.9-9.3-6.7h11.4zm64.8 0l3.6 10.9h11.4l-9.2 6.7 3.5 11-9.3-6.8-9.2 6.7 3.5-10.9-9.2-6.7h11.4zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.6 11-9.3-6.8-9.3 6.7 3.6-10.9-9.3-6.7h11.5zM64.9 39.4l3.5 10.9h11.5L70.6 57 74 67.9l-9-6.7-9.3 6.7L59 57l-9-6.7h11.4zm64.8 0l3.6 10.9h11.4l-9.3 6.7 3.6 10.9-9.3-6.7-9.3 6.7L124 57l-9.3-6.7h11.5zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 10.9-9.2-6.7-9.3 6.7 3.5-10.9-9.2-6.7H191zm64.8 0l3.6 10.9h11.4l-9.3 6.7 3.6 10.9-9.3-6.7-9.2 6.7 3.5-10.9-9.3-6.7H256zm64.9 0l3.5 10.9h11.5L330 57l3.5 10.9-9.2-6.7-9.3 6.7 3.5-10.9-9.2-6.7h11.4zM32.4 66.9L36 78h11.4l-9.2 6.7 3.5 10.9-9.3-6.8-9.2 6.8 3.5-11-9.3-6.7H29zm64.9 0l3.5 11h11.5l-9.3 6.7 3.5 10.9-9.2-6.8-9.3 6.8 3.5-11-9.2-6.7h11.4zm64.8 0l3.6 11H177l-9.2 6.7 3.5 10.9-9.3-6.8-9.2 6.8 3.5-11-9.3-6.7h11.5zm64.9 0l3.5 11H242l-9.3 6.7 3.6 10.9-9.3-6.8-9.3 6.8 3.6-11-9.3-6.7h11.4zm64.8 0l3.6 11h11.4l-9.2 6.7 3.5 10.9-9.3-6.8-9.2 6.8 3.5-11-9.2-6.7h11.4zm64.9 0l3.5 11h11.5l-9.3 6.7 3.6 10.9-9.3-6.8-9.3 6.8 3.6-11-9.3-6.7h11.5zM64.9 94.5l3.5 10.9h11.5l-9.3 6.7 3.5 11-9.2-6.8-9.3 6.7 3.5-10.9-9.2-6.7h11.4zm64.8 0l3.6 10.9h11.4l-9.3 6.7 3.6 11-9.3-6.8-9.3 6.7 3.6-10.9-9.3-6.7h11.5zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 11-9.2-6.8-9.3 6.7 3.5-10.9-9.2-6.7H191zm64.8 0l3.6 10.9h11.4l-9.2 6.7 3.5 11-9.3-6.8-9.2 6.7 3.5-10.9-9.3-6.7H256zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 11-9.2-6.8-9.3 6.7 3.5-10.9-9.2-6.7h11.4zM32.4 122.1L36 133h11.4l-9.2 6.7 3.5 11-9.3-6.8-9.2 6.7 3.5-10.9-9.3-6.7H29zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 10.9-9.2-6.7-9.3 6.7 3.5-10.9-9.2-6.7h11.4zm64.8 0l3.6 10.9H177l-9.2 6.7 3.5 11-9.3-6.8-9.2 6.7 3.5-10.9-9.3-6.7h11.5zm64.9 0l3.5 10.9H242l-9.3 6.7 3.6 11-9.3-6.8-9.3 6.7 3.6-10.9-9.3-6.7h11.4zm64.8 0l3.6 10.9h11.4l-9.2 6.7 3.5 11-9.3-6.8-9.2 6.7 3.5-10.9-9.2-6.7h11.4zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.6 11-9.3-6.8-9.3 6.7 3.6-10.9-9.3-6.7h11.5zM64.9 149.7l3.5 10.9h11.5l-9.3 6.7 3.5 10.9-9.2-6.8-9.3 6.8 3.5-11-9.2-6.7h11.4zm64.8 0l3.6 10.9h11.4l-9.3 6.7 3.6 10.9-9.3-6.8-9.3 6.8 3.6-11-9.3-6.7h11.5zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 10.9-9.2-6.8-9.3 6.8 3.5-11-9.2-6.7H191zm64.8 0l3.6 10.9h11.4l-9.2 6.7 3.5 10.9-9.3-6.8-9.2 6.8 3.5-11-9.3-6.7H256zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 10.9-9.2-6.8-9.3 6.8 3.5-11-9.2-6.7h11.4zM32.4 177.2l3.6 11h11.4l-9.2 6.7 3.5 10.8-9.3-6.7-9.2 6.7 3.5-10.9-9.3-6.7H29zm64.9 0l3.5 11h11.5l-9.3 6.7 3.6 10.8-9.3-6.7-9.3 6.7 3.6-10.9-9.3-6.7h11.4zm64.8 0l3.6 11H177l-9.2 6.7 3.5 10.8-9.3-6.7-9.2 6.7 3.5-10.9-9.3-6.7h11.5zm64.9 0l3.5 11H242l-9.3 6.7 3.6 10.8-9.3-6.7-9.3 6.7 3.6-10.9-9.3-6.7h11.4zm64.8 0l3.6 11h11.4l-9.2 6.7 3.5 10.8-9.3-6.7-9.2 6.7 3.5-10.9-9.2-6.7h11.4zm64.9 0l3.5 11h11.5l-9.3 6.7 3.6 10.8-9.3-6.7-9.3 6.7 3.6-10.9-9.3-6.7h11.5zM64.9 204.8l3.5 10.9h11.5l-9.3 6.7 3.5 11-9.2-6.8-9.3 6.7 3.5-10.9-9.2-6.7h11.4zm64.8 0l3.6 10.9h11.4l-9.3 6.7 3.6 11-9.3-6.8-9.3 6.7 3.6-10.9-9.3-6.7h11.5zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 11-9.2-6.8-9.3 6.7 3.5-10.9-9.2-6.7H191zm64.8 0l3.6 10.9h11.4l-9.2 6.7 3.5 11-9.3-6.8-9.2 6.7 3.5-10.9-9.3-6.7H256zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.5 11-9.2-6.8-9.3 6.7 3.5-10.9-9.2-6.7h11.4zM32.4 232.4l3.6 10.9h11.4l-9.2 6.7 3.5 10.9-9.3-6.7-9.2 6.7 3.5-11-9.3-6.7H29zm64.9 0l3.5 10.9h11.5L103 250l3.6 10.9-9.3-6.7-9.3 6.7 3.6-11-9.3-6.7h11.4zm64.8 0l3.6 10.9H177l-9 6.7 3.5 10.9-9.3-6.7-9.2 6.7 3.5-11-9.3-6.7h11.5zm64.9 0l3.5 10.9H242l-9.3 6.7 3.6 10.9-9.3-6.7-9.3 6.7 3.6-11-9.3-6.7h11.4zm64.8 0l3.6 10.9h11.4l-9.2 6.7 3.5 10.9-9.3-6.7-9.2 6.7 3.5-11-9.2-6.7h11.4zm64.9 0l3.5 10.9h11.5l-9.3 6.7 3.6 10.9-9.3-6.7-9.3 6.7 3.6-11-9.3-6.7h11.5z" transform="scale(.9375)"/>
  </g>';

$flagRu = '<g fill-rule="evenodd" stroke-width="1pt">
    <path fill="#fff" d="M0 0h640v480H0z"/>
    <path fill="#0039a6" d="M0 160h640v320H0z"/>
    <path fill="#d52b1e" d="M0 320h640v160H0z"/>
  </g>';

$flagUa = '<g fill-rule="evenodd" stroke-width="1pt">
    <path fill="#ffd500" d="M0 0h640v480H0z"/>
    <path fill="#005bbb" d="M0 0h640v240H0z"/>
  </g>';


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
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top" style="opacity: 100%">
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                    @auth
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a>
                        </li>
                        @if($count > 10)
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('train.index') }}">{{ __('messages.main.training') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('statistic') }}">{{ __('messages.main.statistics') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('favorite') }}">{{ __('messages.main.favorite') }}</a>
                            </li>

                        @endif
                    @endauth
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('help') }}">{{ __('messages.main.help') }}</a>
                        </li>
                    <li class="nav-item">
                        <!-- Example single danger button -->
                        <span class="btn-group">
                                    <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
{{--                                        {{ ucfirst($lang) }}--}}
                                        <svg xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-ru"
                                             viewBox="0 0 640 480" width="1.2em" height="1.2em">
                                                      <?php
                                            if($lang) {
                                                $name = 'flag' . ucfirst($lang);
                                            } else {
                                            $name = 'flagEn';
                                            }
                                            echo $$name?>
                                                    </svg>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                               href="{{ route('home.checkLang', ['id' => 'ru']) }}">
{{--                                                Ru--}}

                                                <span class="flag-icon flag-icon-gr flag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-ru"
                                                         viewBox="0 0 640 480" width="2em" height="2em">
                                                      <?php echo $flagRu?>
                                                    </svg>
                                                </span>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                               href="{{ route('home.checkLang', ['id' => 'en']) }}">
{{--                                                En--}}
                                                <span class="flag-icon flag-icon-gr flag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-ru"
                                                         viewBox="0 0 640 480" width="2em" height="2em">
                                                    <?php echo $flagEn?>
                                                    </svg>
                                                </span>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                               href="{{ route('home.checkLang', ['id' => 'ua']) }}">
{{--                                                Ua--}}
                                                <span class="flag-icon flag-icon-gr flag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-ru"
                                                         viewBox="0 0 640 480" width="2em" height="2em">
                                                      <?php echo $flagUa?>
                                                    </svg>
                                                </span>
                                            </a></li>
                                    </ul>
                                </span>
                    </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.auth.login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('register') }}">{{ __('messages.auth.register') }}</a>
                            </li>
                        @endif
                    @else
                        @if(isset($language_id))
                            <li class="nav-item"
                                style="padding-bottom: 0.5rem; padding-top: 0.5rem;">{{ __('messages.main.words') }}:
                                <span class="b">
                                        <a class="link"
                                           href="{{ route('dictionary', ['language_id' => $language_id]) }}"
                                           target="_blank">
                            <?php
                                            if (isset(\App\Models\Statistics::getStatisticOne($language_id, date('Y-m-d', time()))->words)) {
                                                $countToday = \App\Models\Statistics::getStatisticOne($language_id, date('Y-m-d', time()))->words;
                                            } else {
                                                $countToday = 0;
                                            }

                                            $countWords = \App\Models\Statistics::getStatisticTotal($language_id)->sum('words');
                                            ?>

                                            {{ $countWords }}
                                            @if($countToday > 0)
                                                (<span
                                                    style="{{ \App\Models\Statistics::getColor($countToday) }}">{{ $countToday }}</span>)
                                            @endif
                                        </a>
                                    </span></li>&nbsp;&nbsp;&nbsp;
                        @endif

                        @if(isset($language_id))
                            <li class="nav-item"
                                style="padding-bottom: 0.5rem; padding-top: 0.5rem; padding-right: 1em;">
                                <span>{{ __('messages.main.added') }}: <span class="b" style="{{ \App\Models\Statistics::getColor(\App\Models\Statistics::getCreatedToday($language_id)) }}">{{ \App\Models\Statistics::getCreatedToday($language_id) }}</span>
                            </li>
                        @endif

                        @if(isset($language_id))
                            <li class="nav-item"
                                style="padding-bottom: 0.5rem; padding-top: 0.5rem; padding-right: 1em;">
                                {{ __('messages.main.repeated') }}: <span class="b" id="repeated"
                                                                          style="{{ \App\Models\Statistics::getColor(\App\Models\Statistics::getRepeatedToday($language_id)) }}">
                                            {{ \App\Models\Statistics::getRepeatedToday($language_id) }}
                                        </span>
                            </li>
                        @endif
                        @if(isset($language_id))
                            <li class="nav-item"
                                style="padding-bottom: 0.5rem; padding-top: 0.5rem; padding-right: 1em;">
                                {{ __('messages.main.read') }}: <span id="read" class="b"
                                                                      style="{{ \App\Models\Statistics::getColor(\App\Models\Statistics::getReadToday($language_id)) }}">{{ \App\Models\Statistics::getReadToday($language_id) }}</span>&nbsp;
                            </li>
                        @endif
                        <?php if (isset($language_id)) $time = \App\Models\Time::getTimeToday($language_id) ?>
                        @if(isset($language_id))
                            @if(isset($time))
                                <li class="nav-item"
                                    style="padding-bottom: 0.5rem; padding-top: 0.5rem; padding-right: 1em;">
                                    <span id="time">(<b style="color:blue;">{{ $time['hours'] }}</b>:<b
                                            style="color:blue;">{{ $time['minutes'] }}</b>:<b
                                            style="color:blue;">{{ $time['seconds'] }}</b>)</span>
                                </li>
                            @else
                                <li class="nav-item"
                                    style="padding-bottom: 0.5rem; padding-top: 0.5rem; padding-right: 1em;">
                                    <span id="time">(<b style="color:blue;">00</b>:<b style="color:blue;">00</b>:<b
                                            style="color:blue;">00</b>)</span>
                                </li>
                            @endif
                        @endif


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('messages.auth.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a class="dropdown-item" href="{{ route('options') }}" >
{{--                                    Настройки--}}
                                    {{ __('messages.options.options') }}
                                </a>


                            </div>

                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div style="margin-top: 3.5em;">
            @yield('content')
        </div>

    </main>
</div>


<footer class="mt-4 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h5><a class="navbar-brand link" href="
                    @auth
                    {{ route('home') }}
                    @else
                    {{ url('/') }}
                    @endauth
                        ">
                        {{ config('app.name', 'Laravel') }}
                    </a></h5>
                <ul class="nav flex-column">
                    @auth
                        <li class="nav-item mb-2 text-muted">
                            <a class="nav-link p-0 text-muted"
                               href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a>
                        </li>
                        @if($count > 100)
                            <li class="nav-item mb-2 text-muted">
                                <a class="nav-link p-0 text-muted"
                                   href="{{ route('train.index') }}">{{ __('messages.main.training') }}</a>
                            </li>

                            <li class="nav-item mb-2 text-muted">
                                <a class="nav-link p-0 text-muted"
                                   href="{{ route('statistic') }}">{{ __('messages.main.statistics') }}</a>
                            </li>

                            <li class="nav-item mb-2 text-muted">
                                <a class="nav-link p-0 text-muted"
                                   href="{{ route('favorite') }}">{{ __('messages.main.favorite') }}</a>
                            </li>
                        @endif
                    @endauth

                </ul>
            </div>

            <div class="col-2">

            </div>

            <div class="col-2">

            </div>

            <?php if (isset($language)) {
                $languageDefault = $language;
            }?>

            @if(isset($languageDefault) && $languageDefault)
                <div class="col-lg-6 ">

                    <h5>{{ __('messages.main.search') }}</h5>
                    <p>{{ __('messages.main.start_to_find') }}</p>
                    <form action="{{ route('search.by_phrase') }}" method="get">

                        <div class="d-flex w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Введите текст</label>
                            <input type="hidden" name="language_id" value="<?=$languageDefault->id?>">
                            <input id="newsletter1" name="word" type="text" class="form-control" placeholder="Текст">

                            <button class="btn btn-primary" type="submit">{{ __('messages.main.search') }}</button>

                        </div>
                        <div class="mt-2">
                            <span>{{ __('messages.main.Search_language') }}: {{ $languageDefault->title }}</span>
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
                {{ __('messages.main.copyright') }}.</p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-dark" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#twitter"/>
                        </svg>
                    </a></li>
                <li class="ms-3"><a class="link-dark" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#instagram"/>
                        </svg>
                    </a></li>
                <li class="ms-3"><a class="link-dark" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#facebook"/>
                        </svg>
                    </a></li>
            </ul>
        </div>
    </div>
</footer>
@stack('bottom')


</body>
</html>
