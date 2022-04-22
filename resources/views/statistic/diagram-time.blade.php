@extends('layouts.app')
@section('title', $title = $scheduleValue['title'])
@push('top')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
@endpush

@push('bottom')
    <script src="/js/diagramValue-small.js"></script>
    <script src="/js/diagram-time.js"></script>

@endpush
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('language.show', ['language' => $language_id]) }}">{{ $language->title }}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('statistic') }}">Статистика</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <form id="form" action="" method="post">
            @csrf
        </form>


        <div class="mb-3">
            @if($period == 20)
                @if(\App\Models\Time::checkCountDays($language_id, $middleDays))
                    <a href="{{ route('statistic.diagram.time', ['language_id' => $language_id, 'period' => 100]) }}"
                       class="btn btn-primary">Диаграмма за 100 дней</a>
                @endif

                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => $period]) }}"
                       class="btn btn-warning">Диаграмма повторения и чтения</a>

                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 20]) }}"
                       class="btn btn-warning">Диаграмма фраз и слов</a>

                    <a href="{{ route('statistic.diagram.time', ['language_id' => $language_id, 'period' => $period, 'startAdd' => $startAdd]) }}" class="btn btn-success">
                        Еще за {{ $period }} дней
                    </a>

                @if(\App\Models\Time::checkCountDays($language_id, $maxDays))
                    {{--                    //показ кнопки за все время--}}
                        <a href="{{ route('statistic.diagram.time', ['language_id' => $language_id, 'period' => 500]) }}"
                           class="btn btn-info lastButton" >За все время</a>
                    {{--                    //конец кнопки за все время--}}
                @endif

                @elseif($period == 100)
                    <a href="{{ route('statistic.diagram.time', ['language_id' => $language_id, 'period' => 20]) }}"
                       class="btn btn-primary">Диаграмма за 20 дней</a>

                @if(\App\Models\Time::checkCountDays($language_id, $maxDays))
                <a href="{{ route('statistic.diagram.time', ['language_id' => $language_id, 'period' => $period, 'startAdd' => $startAdd]) }}"
                   class="btn btn-success">Еще за {{ $period }} дней</a>
                @endif

                @if(\App\Models\Time::checkCountDays($language_id, $maxDays))
                    {{--                    //показ кнопки за все время--}}
                    <a href="{{ route('statistic.diagram.time', ['language_id' => $language_id, 'period' => 500]) }}"
                       class="btn btn-info lastButton" >За все время</a>
                    {{--                    //конец кнопки за все время--}}
                @endif

            @endif

        </div>
        <?php $middleTime = \App\Models\Time::getHMS($middle);?>
        <div>
            <span class="text-danger">В среднем в день времени: {{ $middleTime['hours'] . ' : ' . $middleTime['minutes'] . ' : ' . $middleTime['seconds'] }}</span>
        </div>

        <h2 class="b mb-4">{{ $title }}: {{ $language->title }}</h2>

        <div class="">
            <canvas id="myChart" width="400" height="150"></canvas>
        </div>

        <div class="mt-5">
            <br>
            <canvas id="myChart2" width="400" height="150"></canvas>
        </div>


        {{-- Передача данных в графики  -----------------------------}}
        <input id="scheduleValue" type="hidden" data-firstName="{{ $scheduleValue['name1'] }}"
               data-secondName=""
               data-firstProgressName="{{ $scheduleValue['progressName1'] }}"
               data-secondProgressName=""
               data-color1="{{ $color['color1'] }}"
               data-color2=""
               data-bg1="{{ $color['background1'] }}"
               data-bg2=""
        >

        @if($count1)
            @for($i = 0; $i < count($count1); $i++)
                <input class="inputValue" type="hidden" data-countFirst="{{ $count1[$i] }}"
                       data-countSecond=""
                       data-date="{{ $dates1[$i] }}"
                       data-dateSecond=""
                       data-progressFirst="{{ $countProgress1[$i] }}"
                       data-progressSecond=""
                    >
            @endfor
        @endif


    </div>
@endsection
