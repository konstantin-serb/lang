<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'statistics';
    public $timestamps = false;


    public function language()
    {
        return $this->belongsTo(Language::class);
    }


    public static function getStatisticToday()
    {
        $statistics  = self::where('user_id', auth()->id())
            ->where('date', '=', date('Y-m-d'))
            ->get();
        return $statistics;
    }

    function getToday($language_id)
    {
        return self::where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
            ->where('date', '=', date('Y-m-d'))
            ->first();
    }

    public static function getCreatedToday($language_id)
    {
        $statistics  = self::getToday($language_id);

        if(isset($statistics->created)) {
            return $statistics->created;
        } else {
            return 0;
        }
    }


    public static function getReadToday($language_id)
    {
        $statistics  = self::getToday($language_id);

        if(isset($statistics->readed)) {
            return $statistics->readed;
        } else {
            return 0;
        }
    }


    public static function getRepeatedToday($language_id)
    {
        $statistics  = self::getToday($language_id);

        if(isset($statistics->repeated)) {
            return $statistics->repeated;
        } else {
            return 0;
        }
    }


    public static function getNewWordsToday($language_id)
    {
        $statistics  = self::getToday($language_id);

        if(isset($statistics->words)) {
            return $statistics->words;
        } else {
            return 0;
        }
    }



    public static function getStatisticTotal($language_id)
    {
        $statistics  = self::where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
            ->orderBy('date')
            ->get();
        return $statistics;
    }


    public static function getRepeatedTotal($language_id)
    {
        $statistic = self::getStatisticTotal($language_id);
        return $statistic->sum('repeated');
    }


    public static function getReadTotal($language_id)
    {
        $statistic = self::getStatisticTotal($language_id);
        return $statistic->sum('readed');
    }

    public static function getStatisticOne($language_id, $date)
    {
        $user_id = auth()->id();
        $statistic = Statistics::where('user_id', $user_id)
            ->where('language_id', '=', $language_id)
            ->where('date', '=', $date)
            ->first();
        return $statistic;
    }


    public static function minusWordsCalculate($word)
    {
        $date = date('Y-m-d', strtotime($word->created_at));
        $statistic = self::getStatisticOne($word->language_id, $date);
        $statistic->words = $statistic->words - 1;
        $statistic->save();
    }


    public static function plusWordsCalculate($word)
    {
        $date = date('Y-m-d', strtotime($word->created_at));
        $statistic = self::getStatisticOne($word->language_id, $date);
        $statistic->words = $statistic->words + 1;
        $statistic->save();
    }


    public static function getColor($count)
    {
        if($count == 0) {
            return 'color: black;';
        }

        if($count > 500) {
            return 'color: #b22222';
        }

        if($count > 100) {
            return 'color: blue;';
        }

        if($count < 100) {
            return 'color:#800080;';
        }
    }

    public function getNumberGregDay($date)
    {
        $innerDate = getdate(strtotime($date));
        $numberDay =gregoriantojd($innerDate['mon'], $innerDate['mday'], $innerDate['year']);
        return $numberDay;
    }

    public static function checkCountDays($language_id, $minDays=7)
    {
        $statistics = self::getStatisticTotal($language_id);
        $count = $statistics->count();
        if($count > 10) {
            $startGregorian = self::getNumberGregDay($statistics[0]->date);
            $endGregorian = self::getNumberGregDay($statistics[$count-1]->date);
            $difference = $endGregorian - $startGregorian;
            if($difference >= $minDays) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }


    }


    public static function calculateStartAndEnd($language_id)
    {
        $countStep = 19;
        $statistics = self::getStatisticTotal($language_id);
        $count = $statistics->count();
        $startGregorian = self::getNumberGregDay($statistics[0]->date);
        $endGregorian = self::getNumberGregDay($statistics[$count-1]->date);
        $difference = $endGregorian - $startGregorian;

        $period = intval(round($difference / $countStep));
        if($period < 2) {
            $period = 2;
        }

        return [
            'start' => $statistics[0]->date,
            'end' => $statistics[$count-1]->date,
            'period' => $period,
        ];
    }



}
