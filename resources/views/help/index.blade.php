@extends('layouts.app')
@section('title', $title = 'Справка')
@section('content')

    <div class="container" style="font-size: 1rem;">
        <h2 class="b">{{ $title }}</h2>
        {{--            <div class="mt-3">--}}
        {{--                <a href="{{ route('help.part', ['part' => 'test']) }}" class="myLink">--}}
        {{--                    Test title--}}
        {{--                </a>--}}
        {{--            </div>--}}
        <div class="mt-4">
            <p>
                Привет друзья! Если вы первый раз на моем Сайте, и хотите с его помощью учить иностаннный язык или
                языки,
                обязательно прочтите справку по работе с Сайтом, чтобы быстрее разобраться и приступить к изучению.
            </p>
            <p>
                <a href="{{ route('help.part', ['part' => '01_start']) }}" class="a-help">
                    1. Что такое сайт LANGUAGES и для кого он предназначен
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '02_registration']) }}" class="a-help">
                    2. Начало работы. Регистрация и вход на сайт
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '03_language']) }}" class="a-help">
                    3. Первые настройки. Добавление изучаемого языка и разделов
                </a>
                <br>
                <a href="{{ route('help.part', ['part' => '04_phrase']) }}" class="a-help">
                    4. Добавление и редактирование фраз
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '05_learn_section']) }}" class="a-help">
                    5. Учеба по разделу
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '06_learn_some_section']) }}" class="a-help">
                    6. Учеба по нескольким разделам
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '07_train']) }}" class="a-help">
                    7. Учеба через меню "Тренировка"
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '08_favorite']) }}" class="a-help">
                    8. Избранное
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '09_statistic']) }}" class="a-help">
                    9. Статистика
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '10_dictionary']) }}" class="a-help">
                    10. Словарь и поиск по слову
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '11_search']) }}" class="a-help">
                    11. Простой поиск
                </a>

                <br>
                <a href="{{ route('help.part', ['part' => '12_advices']) }}" class="a-help">
                    12. Советы автора по пользованию сайтом.
                </a>
            </p>
        </div>
    </div>

@endsection
