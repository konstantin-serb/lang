@extends('layouts.app')
@section('title', $title = 'Статистика за '. $period . ' дней')
@push('top')
{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

@endpush

@push('bottom')
    <script src="/js/diagramValue-1.js"></script>
    <script src="/js/diagram-1.js"></script>

@endpush
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('statistic') }}">Статистика</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <form id="form" action="" method="post">
            @csrf
        </form>

        <h2 class="b">{{ $title }}</h2>

        <div class="">
            <canvas id="myChart" width="400" height="150"></canvas>
        </div>

        <div class="mt-5">
            <br>
            <canvas id="myChart2" width="400" height="150"></canvas>
        </div>


{{-- Передача данных в графики  -----------------------------}}
        <input id="scheduleValue" type="hidden" data-name="{{ $scheduleValue['name'] }}" data-progressName="{{ $scheduleValue['progressName'] }}">

        @if($count)
            @for($i = 0; $i < count($count); $i++)
                <input class="inputValue" type="hidden" data-count="{{ $count[$i] }}" data-date="{{ $dates[$i] }}" data-progress="{{ $countProgress[$i] }}">
            @endfor
        @endif





    </div>
@endsection
