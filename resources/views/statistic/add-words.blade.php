@extends('layouts.app')
@section('title', $title = 'Статистика по языку: ')
@push('bottom')
    <script src="/js/jquery.js"></script>

@endpush
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@push('top')

@endpush
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('language.show', ['language' => $language->id]) }}">{{ $language->title }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <form id="form" action="" method="post">
            @csrf
        </form>

        <h2 class="b">{{ $title }} {{$language->title}}</h2>

        <h4 class="mt-4">Добавление новых слов</h4>

        @foreach($countWordsForWeek as $count)
        <input type="hidden" class="wordsArray" data-id="{{ $count }}">
        @endforeach

        @foreach($dateArray as $date)
            <input type="hidden" class="dateArray" data-id="{{ $date }}">
        @endforeach


        <canvas id="myChart" width="400" height="150"></canvas>

        <script>
            let allDates = document.querySelectorAll('.dateArray');
            let allCount = document.querySelectorAll('.wordsArray');

            let arrayDates = [];
            for(let i = 0; i < allDates.length; i++) {
                arrayDates[i] = allDates[i].getAttribute('data-id');
            }


            let arrayCount = [];
            for(let i = 0; i < allCount.length; i++) {
                arrayCount[i] = allCount[i].getAttribute('data-id');
            }



            const data = {
                labels: arrayDates,
                datasets: [{
                    label: 'Добавление новых слов',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: arrayCount,
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {}
            };
        </script>

        <script>
            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>


    </div>
@endsection
