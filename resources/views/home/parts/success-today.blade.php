<?php
use App\Models\Statistics;
?>
<div class="" style="background-color:rgba(244,255,0,0.26); margin-top:-1.2em; padding-top: 1em; padding-bottom: 1em; margin-bottom: 1em;">
    {{--<hr>--}}
    <div class="container">
        <h4 class="b">Успехи за сегодня: </h4>

        @foreach($statistics as $statistic)
            <div class="mt-3">
                <h5 class="b">{{ $statistic->language->title }}:</h5>
                <div class="row">
                    <div class="col-lg-3">
                        <?php $created = Statistics::getCreatedToday($statistic->language_id)?>
                        Фраз добавлено: <span class="b" style="{{ Statistics::getColor($created) }}">{{ $created }}</span>
                    </div>
                    <div class="col-lg-3">
                        <?php $words = Statistics::getNewWordsToday($statistic->language_id)?>
                        Новых слов добавлено: <span class="b" style="{{ Statistics::getColor($words) }}">{{ $words }}</span>
                    </div>
                    <div class="col-lg-3">
                        <?php $repeat = Statistics::getRepeatedToday($statistic->language_id)?>
                        Повторено: <span class="b" style="{{ Statistics::getColor($repeat) }}">{{ $repeat }}</span>
                    </div>
                    <div class="col-lg-3">
                        <?php $read = Statistics::getReadToday($statistic->language_id)?>
                        Прочитано: <span class="b" style="{{ Statistics::getColor($read) }}">{{ $read }}</span>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
{{--    <hr>--}}
</div>
