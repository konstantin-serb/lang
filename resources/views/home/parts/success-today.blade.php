<?php
use App\Models\Statistics;
?>
<div class="" style="background-color:rgba(244,255,0,0.26); margin-top:-1.2em; padding-top: 1em; padding-bottom: 1em; margin-bottom: 1em;">
    {{--<hr>--}}
    <div class="container">
        <h4 class="b">{{ __('messages.home.success_today') }}: </h4>

        @foreach($statistics as $statistic)
            <div class="mt-3">
                <h5 class="b">{{ $statistic->language->title }}:</h5>
                <div class="row">
                    <div class="col-lg-3">
                        <?php $created = Statistics::getCreatedToday($statistic->language_id)?>
                            {{ __('messages.home.phrases_added') }}: <span class="b" style="{{ Statistics::getColor($created) }}">{{ $created }}</span>
                    </div>
                    <div class="col-lg-3">
                        <?php $words = Statistics::getNewWordsToday($statistic->language_id)?>
                            {{ __('messages.home.new_words_added') }}: <span class="b" style="{{ Statistics::getColor($words) }}">{{ $words }}</span>
                    </div>
                    <div class="col-lg-3">
                        <?php $repeat = Statistics::getRepeatedToday($statistic->language_id)?>
                            {{ __('messages.home.repeated') }}: <span class="b" style="{{ Statistics::getColor($repeat) }}">{{ $repeat }}</span>
                    </div>
                    <div class="col-lg-3">
                        <?php $read = Statistics::getReadToday($statistic->language_id)?>
                            {{ __('messages.home.read') }}: <span class="b" style="{{ Statistics::getColor($read) }}">{{ $read }}</span>
                    </div>

                </div>
                <?php $time = \App\Models\Time::getTimeToday($statistic->language->id) ?>
                @if($time)
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            {{ __('messages.home.time_to_study') }}:
                                <nobr><b style="color: blue">{{ $time['hours'] }}</b>
                                : <b style="color: blue">{{ $time['minutes'] }}</b>
                                    : <b style="color: blue">{{ $time['seconds'] }}</b></nobr>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    @endforeach
{{--    <hr>--}}
</div>
