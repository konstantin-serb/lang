<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $table = 'times';
    protected $guarded = false;
    public $timestamps = false;


    public static function setTime($language_id)
    {
        $maxLast = 180;
        $date = date('Y-m-d', time());
        $model = self::firstOrNew(['user_id' => auth()->id(),
            'language_id' => $language_id,
            'date' => $date]);
        if($model->last_time) {
            $delta = time() - $model->last_time;
            if($delta <= $maxLast) {
                $time = $model->time + $delta;
                $model->time = $time;
            }
            $model->last_time = time();
        } else {
            $model->last_time = time();
            $model->time = 0;
        }
        $model->save();
    }


    public static function getTimeToday($language_id, $user_id=false)
    {
        if(!$user_id) {
            $user_id = auth()->id();
        }
        $dateToday = date('Y-m-d', time());
        $model = self::where('user_id', $user_id)
            ->where('language_id', '=', $language_id)
            ->where('date', '=', $dateToday)
            ->first();

        if($model) {
            $timeToday = $model->time;
            $result = self::getHMS($timeToday);

        } else {
            $result = null;
        }

        return $result;
    }


    public static function getHMS($time)
    {
        if($time >= 3600) {
            $hours = intval(floor($time / (3600)));
            $remainder = $time - $hours * 3600;
            if($remainder >= 60) {
                $minutes = intval(floor($remainder / 60));
                $seconds = intval($remainder - $minutes * 60);
            } else {
                $minutes = 0;
                $seconds = intval($remainder - $minutes * 60);
            }
        } elseif($time >= 60) {
            $hours = 0;
            $minutes = intval(floor($time / 60));
            $seconds = intval($time - $minutes * 60);
        } elseif($time < 60) {
            $hours = 0;
            $minutes = 0;
            $seconds = intval($time);
        }


        if(strlen($hours) == 1) {
            $hours = 0 . $hours;
        };

        if(strlen($minutes) == 1) {
            $minutes = 0 . $minutes;
        };

        if(strlen($seconds) == 1) {
            $seconds = 0 . $seconds;
        };

        $answer = [
            'hours' => $hours,
            'minutes' => $minutes,
            'seconds' => $seconds,
        ];

        return $answer;
    }


    public static function getAllTimes($language_id, $user_id=false)
    {
        if(!$user_id) {
            $user_id = auth()->id();
        }
        $model = self::where('user_id', $user_id)
            ->where('language_id', '=', $language_id)
            ->get();
        return $model;
    }


    public static function getArraysForDiagrams($start, $end, $language_id, $daysAdd, $all)
    {
        $i = $start;

        if($daysAdd > 1) {
            $end = date('Y-m-d', strtotime('-1 day', strtotime($end)));
        }

        $countArray = [];
        $dateArray = [];
        $num = 0;

        $middle = 0;
        $count = 0;
        $sumAll = 0;
        $nextDate = date('Y-m-d', strtotime('+' . $daysAdd . ' days', strtotime($i)));
        while ($nextDate <= $end):
            $nextDate = date('Y-m-d', strtotime('+' . $daysAdd . ' days', strtotime($i)));
            if($num > 0 && $daysAdd > 1) $i = date('Y-m-d', strtotime('+1 day', strtotime($i)));

            if($daysAdd === 1) {
                $items = Time::where('user_id', auth()->id())->where('language_id', '=', $language_id)
                    ->where('date', '=', $i)->get();
            } else {
                $items = Time::where('user_id', auth()->id())->where('language_id', '=', $language_id)
                    ->whereBetween('date', [$i, $nextDate])->get();
            }

            $countArray[$num] = round(($items->sum('time')/3600), 2);
            $dateArray[$num] = date('d/m', strtotime($i)) .'-' .date('d/m', strtotime($nextDate));
            if($all) {
                $dateArray[$num] = date('d.m', strtotime($i)) .'-' .date('d.m/y', strtotime($nextDate));
            }

            if($daysAdd === 1) {
                $dateArray[$num] = date('d.m', strtotime($i));
            }

            if($items->sum('time') > 0) {
                $sumAll = $sumAll + $items->sum('time');
                $count++;
            }

            if($sumAll > 0) {
                $middle = (round($sumAll / $count));
            }

            $i = $nextDate;
            $num++;
        endwhile;

        return [
            'count' => $countArray,
            'date' => $dateArray,
            'middle' => $middle,
        ];
    }

    public static function getTimeTotal($language_id)
    {
        $times  = self::where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
            ->orderBy('date')
            ->get();
        return $times;
    }


    public static function calculateStartAndEnd($language_id)
    {
        $countStep = 19;
        $statistics = self::getTimeTotal($language_id);
        $count = $statistics->count();
        $startGregorian = Statistics::getNumberGregDay($statistics[0]->date);
        $endGregorian = Statistics::getNumberGregDay($statistics[$count-1]->date);
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


    public static function checkCountDays($language_id, $minDays=7)
    {
        $statistics = self::getTimeTotal($language_id);
        $count = $statistics->count();
        if($count > 4) {
            $startGregorian = Statistics::getNumberGregDay($statistics[0]->date);
            $endGregorian = Statistics::getNumberGregDay($statistics[$count-1]->date);
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


    public static function getLastVisit($user_id)
    {
        $lastVisit = self::where('user_id', $user_id)
            ->orderBy('last_time', 'desc')
            ->first();
        if($lastVisit) {
            return $lastVisit->last_time;
        } else {
            $user = User::where('id', $user_id)->first();
            return strtotime($user->created_at);
        }

    }


    public static function allItemsTime($user_id)
    {
        $allItems = self::where('user_id', $user_id)
            ->get();
        return $allItems;
    }


    public static function allTimeOnSite($user_id)
    {
        $allItems = self::allItemsTime($user_id);
        return $allItems->sum('time');

    }



}
