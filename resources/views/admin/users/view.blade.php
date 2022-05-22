@extends('layouts.admin')
@section('title', $title = 'User: '. $user->name)
@section('content')
<?php
use App\Models\Statistics;
?>
    <div class="container">
        <h2 class="b">{{ $title }}</h2>

        <div class="mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <h5>Дата регистрации на сайте: <span class="b">{{ date('d M - Y', strtotime($user->created_at)) }}
                        </span>
                    в {{ date('H:i', strtotime($user->created_at)) }}</h5>
                </div>

                <div class="col-lg-12">
                    <h5>Время последнего посещения: <span class="b">{{ date('d M - Y', $latsVisit) }}
                        </span>
                        в {{ date('H:i', $latsVisit) }}</h5>
                </div>

                <div class="col-lg-12">
                    <h5>Общее количество времени изучения: <span class="b">{{ $allUserTime['hours'] }}
                            : {{ $allUserTime['minutes'] }}
                            : {{ $allUserTime['seconds'] }}
                        </span>
                </div>
            </div>
            <hr>
            <h3>Изучаемые языки:</h3>
{{--            <hr>--}}
                @if(!$languages->isEmpty())
                    @foreach($languages as $language)
                    <div class="row" style="border-bottom: #0d6efd dashed 1px; padding-bottom: 1em; padding-top: 1em;">
                        <h4>{{ $language->title }}:</h4>
                        <div class="">
                            <div class="row">
                                <div class="col-lg-3 myStatBlock1">
                                    <?php $createdAll = Statistics::getStatisticTotal($language->id, $user->id)->sum('created');?>
                                        {{--                                Общее количество фраз--}}
                                        {{ __('messages.statistic.total_count_phrases') }}: <span
                                            class="@if($createdAll > 0) b text-primary @endif">{{ $createdAll }}</span>
                                    <br>
                                    <?php $created = Statistics::getCreatedToday($language->id, $user->id)?>
{{--                                    <a href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'created', 'period' => 20]) }}"--}}
{{--                                       class="link">--}}
                                        @if($created > 0) <b> @endif
                                            {{--                                    Добавлено сегодня--}}
                                            {{ __('messages.statistic.added_today') }}: <span
                                                class="@if($created>0) b text-danger @endif">{{ $created }}</span>
                                            @if($created > 0) </b> @endif
{{--                                    </a>--}}

                                </div>
                                <div class="col-lg-3 myStatBlock1">
                                    <?php $repeated = \App\Models\Statistics::getRepeatedTotal($language->id, $user->id)?>
{{--                                    @if(Statistics::checkCountDays($item->id, $middleDays)) <a--}}
{{--                                        href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'repeated', 'period' => 105]) }}"--}}
{{--                                        class="link"> @endif--}}
                                        <span>
{{--                                    Повторено раз--}}
                                            {{ __('messages.statistic.repeated') }}: </span> <span
                                            class="@if($repeated > 0) b text-primary @endif">{{ $repeated }}</span>
{{--                                        @if(Statistics::checkCountDays($item->id, $middleDays)) </a> @endif--}}
                                    <br>
                                    <?php $repeat = Statistics::getRepeatedToday($language->id, $user->id)?>
{{--                                    <a href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'repeated', 'period' => 20]) }}"--}}
{{--                                       class="link">--}}
                                        @if($repeat > 0) <b> @endif
                                            <span>
{{--                                        Повторено сегодня--}}
                                                {{ __('messages.statistic.repeated_today') }}: <span
                                                    class="@if($repeat > 0) b text-danger @endif">{{ $repeat }}</span></span>
                                            @if($repeat > 0) </b> @endif
{{--                                    </a>--}}
                                </div>


                                <div class="col-lg-3 myStatBlock1">
                                    <?php $readed = \App\Models\Statistics::getReadTotal($language->id, $user->id)?>
{{--                                    @if(Statistics::checkCountDays($item->id, $middleDays)) <a--}}
{{--                                        href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'repeated', 'period' => 105]) }}"--}}
{{--                                        class="link"> @endif--}}
                                        <span>
{{--                                    Прочитано раз--}}
                                            {{ __('messages.statistic.read') }}
                                    : </span> <span
                                            class="@if($readed > 0) b text-primary @endif">{{ $readed }}</span>
{{--                                        @if(Statistics::checkCountDays($item->id, $middleDays)) </a> @endif--}}
                                    <br>
                                    <?php $read = Statistics::getReadToday($language->id, $user->id)?>
{{--                                    <a href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'repeated', 'period' => 20]) }}"--}}
{{--                                       class="link">--}}
                                        @if($read > 0) <b> @endif
                                            <span>
{{--                                        Прочитано сегодня--}}
                                                {{ __('messages.statistic.read_today') }}
                                        : </span> <span
                                                class="@if($read > 0) b text-danger @endif">{{ $read }}</span>
                                            @if($read > 0) </b> @endif
{{--                                    </a>--}}
                                </div>

                                <div class="col-lg-3 myStatBlock1">
                                    <?php $words = \App\Models\Dictionary::getForLanguageAll($language->id, $user->id)->count()?>
{{--                                    @if(Statistics::checkCountDays($language->id, $middleDays)) <a--}}
{{--                                        href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'created', 'period' => 105]) }}"--}}
{{--                                        class="link"> @endif--}}
                                        <span>
{{--                                    Словарный запас--}}

                                            {{ __('messages.statistic.vocabulary') }}: </span> <span
                                            class="@if($words > 0) b text-primary @endif">{{ $words }}</span>
{{--                                        @if(Statistics::checkCountDays($item->id, $middleDays)) </a> @endif--}}
                                    <br>
                                    <?php $wordsToday = Statistics::getNewWordsToday($language->id, $user->id)?>
{{--                                    <a href="{{ route('statistic.diagram.small', ['language_id' => $item->id, 'type' => 'created', 'period' => 20]) }}"--}}
{{--                                       class="link">--}}
                                        @if($wordsToday > 0) <b> @endif
                                            <span>
{{--                                        Добавлено сегодня--}}
                                                {{ __('messages.statistic.added_today') }}: </span> <span
                                                class="@if($wordsToday > 0) b text-danger @endif">{{ $wordsToday }}</span>
                                            @if($wordsToday > 0) </b> @endif
{{--                                    </a>--}}
                                </div>

                                <div class="col-lg-12 myStatBlock1">
                                    <?php
                                    $timeAll = \App\Models\Time::getAllTimes($language->id, $user->id);
                                    $timeToday = \App\Models\Time::getTimeToday($language->id, $user->id);
                                    $timeAllHMS = \App\Models\Time::getHMS($timeAll->sum('time'));
                                    ?>
{{--                                    @if(\App\Models\Time::checkCountDays($item->id, $middleDays)) <a--}}
{{--                                        href="{{ route('statistic.diagram.time', ['language_id' => $item->id, 'period' => 105]) }}"--}}
{{--                                        class="link"><b> @endif--}}
                                            <span>
{{--                                        Общее количество времени на изучение--}}
                                                {{ __('messages.statistic.total_time') }}: <span class="
                            @if($timeAll->sum('time') > 0) b text-primary @endif">
                                   &nbsp; {{ $timeAllHMS['hours'] . ' : ' . $timeAllHMS['minutes'] . ' : ' . $timeAllHMS['seconds']  }}
                                </span></span>
{{--                                            @if(\App\Models\Time::checkCountDays($item->id, $middleDays)) </b></a> @endif--}}
                                    &nbsp; &nbsp;
{{--                                    @if($timeAll) --}}
{{--                                            <a--}}
{{--                                        href="{{ route('statistic.diagram.time', ['language_id' => $item->id, 'period' => 20]) }}"--}}
{{--                                        class="link"> @endif--}}

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
{{--                                        @if($timeAll) </a> @endif--}}


                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

        </div>
    </div>

@endsection
