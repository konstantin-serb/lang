@extends('layouts.app')
@section('title', $title = $scheduleValue['title'])
@push('top')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
@endpush

@push('bottom')
    <script src="/js/diagramValue-small.js"></script>
    <script src="/js/diagram-small.js"></script>

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
                <li class="breadcrumb-item"><a href="{{ route('statistic') }}">@lang('messages.statistic.statistic')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <form id="form" action="" method="post">
            @csrf
        </form>

        <?php $timeAll = \App\Models\Time::getAllTimes($language->id);?>

        <div class="mb-3">
            @if($period == 20)
                @if($type == 'created')
                    @if(\App\Models\Statistics::checkCountDays($language_id, $middleDays))
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 105]) }}"
                       class="btn btn-primary">
{{--                        Диаграмма за 105 дней--}}
                        @lang('messages.statistic.diagram_for_n_days', ['n' => 105])
                    </a>
                    @endif
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => $period]) }}"
                       class="btn btn-warning">
{{--                        Диаграмма повторения и чтения--}}
                        @lang('messages.statistic.graph_repetition_and_reading')
                    </a>
                        @if(!$timeAll->isEmpty())
                            <a href="{{ route('statistic.diagram.time', ['language_id' => $language->id, 'period' => $period]) }}"
                               class="btn btn-info">
{{--                                Затраты времени за {{ $period }} дней--}}
                                @lang('messages.statistic.time_spent_n', ['n' => $period])
                            </a>
                        @endif
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => $period, 'startAdd' => $startAdd]) }}"
                       class="btn btn-primary">
{{--                        Еще за {{ $period }} дней--}}
                        @lang('messages.statistic.more_days', ['n' => $period])
                    </a>


                    {{--                    //показ кнопки за все время--}}
                    @if(\App\Models\Statistics::checkCountDays($language_id, $maxDays))
                        <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 500]) }}"
                           class="btn btn-info lastButton" >
{{--                            За все время--}}
                            @lang('messages.statistic.for_all_time')
                        </a>
                    @endif
                    {{--                    //конец кнопки за все время--}}

                @elseif($type = 'repeated')
                    @if(\App\Models\Statistics::checkCountDays($language_id, $middleDays))
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => 105]) }}"
                       class="btn btn-primary">
{{--                        Диаграмма за 105 дней--}}
                        @lang('messages.statistic.diagram_for_n_days', ['n' => 105])
                    </a>
                    @endif

                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 20]) }}"
                       class="btn btn-warning">
{{--                        Диаграмма фраз и слов--}}
                        @lang('messages.statistic.phrase_graph')
                    </a>

                        @if(!$timeAll->isEmpty())
                            <a href="{{ route('statistic.diagram.time', ['language_id' => $language->id, 'period' => $period]) }}"
                               class="btn btn-info">
{{--                                Затраты времени за {{ $period }} дней--}}
                                @lang('messages.statistic.time_spent_n', ['n' => $period])
                            </a>
                        @endif

                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => $period, 'startAdd' => $startAdd]) }}"
                       class="btn btn-primary" >
{{--                        Еще за {{ $period }} дней--}}
                        @lang('messages.statistic.more_days', ['n' => $period])
                    </a>
{{--                    //показ кнопки за все время--}}
                    @if(\App\Models\Statistics::checkCountDays($language_id, $maxDays))
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => 500]) }}"
                       class="btn btn-info lastButton" >
{{--                        За все время--}}
                        @lang('messages.statistic.for_all_time')
                    </a>
                    @endif
{{--                    //конец кнопки за все время--}}
                @endif

            @elseif($period == 105)
                @if($type == 'created')
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 20]) }}"
                       class="btn btn-primary">
{{--                        Диаграмма за 20 дней--}}
                        @lang('messages.statistic.diagram_for_n_days', ['n' => 20])
                    </a>
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => 105]) }}"
                       class="btn btn-warning">
{{--                        Диаграмма повторения и чтения--}}
                        @lang('messages.statistic.graph_repetition_and_reading')
                    </a>

                    @if(\App\Models\Time::checkCountDays($language->id, $middleDays))
                        <a href="{{ route('statistic.diagram.time', ['language_id' => $language->id, 'period' => $period]) }}"
                           class="btn btn-info">
{{--                            Затраты времени за {{ $period }} дней--}}
                            @lang('messages.statistic.time_spent_n', ['n' => $period])
                        </a>
                    @endif

                    @if(\App\Models\Statistics::checkCountDays($language_id, $maxDays))
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => $period, 'startAdd' => $startAdd]) }}"
                       class="btn btn-primary">
{{--                        Еще за {{ $period }} дней--}}
                        @lang('messages.statistic.more_days', ['n' => $period])
                    </a>
                    @endif

                    {{--                    //показ кнопки за все время--}}
                    @if(\App\Models\Statistics::checkCountDays($language_id, $maxDays))
                        <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 500]) }}"
                           class="btn btn-info lastButton" >
{{--                            За все время--}}
                            @lang('messages.statistic.for_all_time')
                        </a>
                    @endif
                    {{--                    //конец кнопки за все время--}}
                @elseif($type = 'repeated')
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => 20]) }}"
                       class="btn btn-primary">
{{--                        Диаграмма за 20 дней--}}
                        @lang('messages.statistic.diagram_for_n_days', ['n' => 20])
                    </a>
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 105]) }}"
                       class="btn btn-warning">
{{--                        Диаграмма фраз и слов--}}
                        @lang('messages.statistic.phrase_graph')
                    </a>

                    @if(\App\Models\Time::checkCountDays($language->id, $middleDays))
                        <a href="{{ route('statistic.diagram.time', ['language_id' => $language->id, 'period' => $period]) }}"
                           class="btn btn-info">
{{--                            Затраты времени за {{ $period }} дней--}}
                            @lang('messages.statistic.time_spent_n', ['n' => $period])
                        </a>
                    @endif

                    @if(\App\Models\Statistics::checkCountDays($language_id, $maxDays))
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => $period, 'startAdd' => $startAdd]) }}"
                       class="btn btn-primary">
{{--                        Еще за {{ $period }} дней--}}
                        @lang('messages.statistic.more_days', ['n' => $period])
                    </a>
                    @endif
                    {{--                    //показ кнопки за все время--}}
                    @if(\App\Models\Statistics::checkCountDays($language_id, $maxDays))
                        <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => 500]) }}"
                           class="btn btn-info lastButton" >
{{--                            За все время--}}
                            @lang('messages.statistic.for_all_time')
                        </a>
                    @endif
                    {{--                    //конец кнопки за все время--}}
                @endif

            @elseif($period == 500)
                @if($type == 'created')
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 20]) }}"
                       class="btn btn-primary">
{{--                        Диаграмма за 20 дней--}}
                        @lang('messages.statistic.diagram_for_n_days', ['n' => 20])
                    </a>
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 105]) }}"
                       class="btn btn-primary">
{{--                        Диаграмма за 105 дней--}}
                        @lang('messages.statistic.diagram_for_n_days', ['n' => 105])
                    </a>
                    {{--                    //показ кнопки за все время--}}
                    @if(\App\Models\Statistics::checkCountDays($language_id, $maxDays))
                        <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => 500]) }}"
                           class="btn btn-warning lastButton" >
{{--                            Повторение и чтение--}}
                            @lang('messages.statistic.graph_repetition_and_reading')
                        </a>
                    @endif
                    {{--                    //конец кнопки за все время--}}
                @elseif($type = 'repeated')
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => 20]) }}"
                       class="btn btn-primary">
{{--                        Диаграмма за 20 дней--}}
                        @lang('messages.statistic.diagram_for_n_days', ['n' => 20])
                    </a>
                    <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'repeated', 'period' => 105]) }}"
                       class="btn btn-primary">
{{--                        Диаграмма за 105 дней--}}
                        @lang('messages.statistic.diagram_for_n_days', ['n' => 105])
                    </a>
                    {{--                    //показ кнопки за все время--}}
                    @if(\App\Models\Statistics::checkCountDays($language_id, $maxDays))
                        <a href="{{ route('statistic.diagram.small', ['language_id' => $language_id, 'type' => 'created', 'period' => 500]) }}"
                           class="btn btn-warning lastButton" >
{{--                            Диаграма фраз и слов--}}
                            @lang('messages.statistic.phrase_graph')
                        </a>
                    @endif
                    {{--                    //конец кнопки за все время--}}
                @endif
            @endif



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
               data-secondName="{{ $scheduleValue['name2'] }}"
               data-firstProgressName="{{ $scheduleValue['progressName1'] }}"
               data-secondProgressName="{{ $scheduleValue['progressName2'] }}"
               data-color1="{{ $color['color1'] }}"
               data-color2="{{ $color['color2'] }}"
               data-bg1="{{ $color['background1'] }}"
               data-bg2="{{ $color['background2'] }}"
        >

        @if($count1)
            @for($i = 0; $i < count($count1); $i++)
                <input class="inputValue" type="hidden" data-countFirst="{{ $count1[$i] }}"
                       data-countSecond="{{ $count2[$i] }}"
                       data-date="{{ $dates1[$i] }}"
                       data-dateSecond="{{ $dates2[$i] }}"
                       data-progressFirst="{{ $countProgress1[$i] }}"
                       data-progressSecond="{{ $countProgress2[$i] }}"
                    >
            @endfor
        @endif


    </div>
@endsection
