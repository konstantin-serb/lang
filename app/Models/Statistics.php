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


    public static function getRepeatedToday($language_id)
    {
        $statistics  = self::where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
            ->where('date', '=', date('Y-m-d'))
            ->first();

        if(isset($statistics->repeated)) {
            return $statistics->repeated;
        } else {
            return 0;
        }
    }


    public static function getCreatedToday($language_id)
    {
        $statistics  = self::where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
            ->where('date', '=', date('Y-m-d'))
            ->first();

        if(isset($statistics->created)) {
            return $statistics->created;
        } else {
            return 0;
        }
    }


    public static function getReadToday($language_id)
    {
        $statistics  = self::where('user_id', auth()->id())
            ->where('date', '=', date('Y-m-d'))
            ->where('language_id', '=', $language_id)
            ->first();

        if(isset($statistics->readed)) {
            return $statistics->readed;
        } else {
            return 0;
        }
    }


    public static function getStatisticTotal($language_id)
    {
        $statistics  = self::where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
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


}
