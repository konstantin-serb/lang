<?php
use App\Models\Statistics;

$middleDays = 30;
?>

@extends('layouts.app')
@section('title', $title = __('messages.statistic.lag_lern_stat'))
@section('content')

    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <form id="form" action="" method="post">
            @csrf
        </form>

        <h2 class="b">{{ $title }}</h2>

        <div class="mt-5">
            @foreach($languages as $item)
                <div class="mt-5">
                    <h3>{{ $item->title }}</h3>
                    <div class="row">
                        <div class="col-lg-3 myStatBlock1">
                            <?php $createdAll = Statistics::getStatisticTotal($item->id)->sum('created');?>
                            @if(Statistics::checkCountDays($item->id, $middleDays)) <a
                                href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'created', 'period' => 100]) }}"
                                class="link"> @endif
{{--                                Общее количество фраз--}}
                                    {{ __('messages.statistic.total_count_phrases') }}: <span
                                    class="@if($createdAll > 0) b text-primary @endif">{{ $createdAll }}</span>
                                @if(Statistics::checkCountDays($item->id, $middleDays)) </a> @endif
                            <br>
                            <?php $created = Statistics::getCreatedToday($item->id)?>
                            @if(Statistics::checkCountDays($item->id)) <a
                                href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'created', 'period' => 20]) }}"
                                class="link"> @endif
                                @if($created > 0) <b> @endif
{{--                                    Добавлено сегодня--}}
                                        {{ __('messages.statistic.added_today') }}: <span
                                        class="@if($created>0) b text-danger @endif">{{ $created }}</span>
                                    @if($created > 0) </b> @endif
                            @if(Statistics::checkCountDays($item->id)) </a> @endif

                        </div>
                        <div class="col-lg-3 myStatBlock1">
                            <?php $repeated = \App\Models\Statistics::getRepeatedTotal($item->id)?>
                            @if(Statistics::checkCountDays($item->id, $middleDays)) <a
                                href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'repeated', 'period' => 100]) }}"
                                class="link"> @endif
                                <span>
{{--                                    Повторено раз--}}
                                    {{ __('messages.statistic.repeated') }}: </span> <span
                                    class="@if($repeated > 0) b text-primary @endif">{{ $repeated }}</span>
                            @if(Statistics::checkCountDays($item->id, $middleDays)) </a> @endif
                            <br>
                            <?php $repeat = Statistics::getRepeatedToday($item->id)?>
                            @if(Statistics::checkCountDays($item->id)) <a
                                href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'repeated', 'period' => 20]) }}"
                                class="link"> @endif
                                @if($repeat > 0) <b> @endif
                                    <span>
{{--                                        Повторено сегодня--}}
                                        {{ __('messages.statistic.repeated_today') }}: <span
                                            class="@if($repeat > 0) b text-danger @endif">{{ $repeat }}</span></span>
                                    @if($repeat > 0) </b> @endif
                                @if(Statistics::checkCountDays($item->id)) </a> @endif
                        </div>


                        <div class="col-lg-3 myStatBlock1">
                            <?php $readed = \App\Models\Statistics::getReadTotal($item->id)?>
                            @if(Statistics::checkCountDays($item->id, $middleDays)) <a
                                href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'repeated', 'period' => 100]) }}"
                                class="link"> @endif
                                <span>
{{--                                    Прочитано раз--}}
                                    {{ __('messages.statistic.read') }}
                                    : </span> <span
                                    class="@if($readed > 0) b text-primary @endif">{{ $readed }}</span>
                                @if(Statistics::checkCountDays($item->id, $middleDays)) </a> @endif
                            <br>
                            <?php $read = Statistics::getReadToday($item->id)?>
                            @if(Statistics::checkCountDays($item->id)) <a
                                href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'repeated', 'period' => 20]) }}"
                                class="link"> @endif
                                @if($read > 0) <b> @endif
                                    <span>
{{--                                        Прочитано сегодня--}}
                                        {{ __('messages.statistic.read_today') }}
                                        : </span> <span
                                        class="@if($read > 0) b text-danger @endif">{{ $read }}</span>
                                    @if($read > 0) </b> @endif
                                @if(Statistics::checkCountDays($item->id)) </a> @endif
                        </div>

                        <div class="col-lg-3 myStatBlock1">
                            <?php $words = \App\Models\Dictionary::getForLanguageAll($item->id)->count()?>
                            @if(Statistics::checkCountDays($item->id, $middleDays)) <a
                                href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'created', 'period' => 100]) }}"
                                class="link"> @endif
                                <span>
{{--                                    Словарный запас--}}

                                    {{ __('messages.statistic.vocabulary') }}: </span> <span
                                    class="@if($words > 0) b text-primary @endif">{{ $words }}</span>
                                @if(Statistics::checkCountDays($item->id, $middleDays)) </a> @endif
                            <br>
                            <?php $wordsToday = Statistics::getNewWordsToday($item->id)?>
                            @if(Statistics::checkCountDays($item->id)) <a
                                href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'created', 'period' => 20]) }}"
                                class="link">@endif
                                @if($wordsToday > 0) <b> @endif
                                    <span>
{{--                                        Добавлено сегодня--}}
                                        {{ __('messages.statistic.added_today') }}: </span> <span
                                        class="@if($wordsToday > 0) b text-danger @endif">{{ $wordsToday }}</span>
                                    @if($wordsToday > 0) </b> @endif
                                @if(Statistics::checkCountDays($item->id))</a> @endif
                        </div>

                        <div class="col-lg-12 myStatBlock1">
                            <?php
                            $timeAll = \App\Models\Time::getAllTimes($item->id);
                            $timeToday = \App\Models\Time::getTimeToday($item->id);
                            $timeAllHMS = \App\Models\Time::getHMS($timeAll->sum('time'));
                            ?>
                                @if(\App\Models\Time::checkCountDays($item->id, $middleDays)) <a
                                href="{{ route('statistic.diagram.time', ['language_id' => $item->id, 'period' => 100]) }}"
                                class="link"><b> @endif
                                    <span>
{{--                                        Общее количество времени на изучение--}}
                                        {{ __('messages.statistic.total_time') }}: <span class="
                            @if($timeAll->sum('time') > 0) b text-primary @endif">
                                   &nbsp; {{ $timeAllHMS['hours'] . ' : ' . $timeAllHMS['minutes'] . ' : ' . $timeAllHMS['seconds']  }}
                                </span></span>
                                        @if(\App\Models\Time::checkCountDays($item->id, $middleDays)) </b></a> @endif
                            &nbsp; &nbsp;
                            @if($timeAll) <a
                                href="{{ route('statistic.diagram.time', ['language_id' => $item->id, 'period' => 20]) }}"
                                class="link"> @endif

                                @if($timeToday) <b> @endif
{{--                                    Сегодня времени потрачено--}}
                                        {{ __('messages.statistic.time_today') }}:
                                    @if($timeToday)
                                        &nbsp; <span class="
                                            @if($timeAll->sum('time') > 0) b text-danger @endif">{{ $timeToday['hours'] . ' : ' . $timeToday['minutes'] . ' : ' . $timeToday['seconds']  }}</span>
                                    @else
                                        <?php $timeToday = \App\Models\Time::getHMS(0);?>
                                        &nbsp; <span
                                            class=" @if($timeAll->sum('time') > 0) b text-danger @endif">{{ $timeToday['hours'] . ' : ' . $timeToday['minutes'] . ' : ' . $timeToday['seconds']  }}</span>
                                    @endif
                                    @if($timeToday) </b> @endif
                                @if($timeAll) </a> @endif


                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>


    </div>
@endsection
