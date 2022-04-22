<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Language;
use App\Models\Statistics;
use App\Models\Time;

class StatisticController extends Controller
{
    public function index()
    {
        $languages = Language::getAll();

        return view('statistic.index', compact('languages'));
    }


    public function getDiagramSmall($language_id, $type, $period, $startAdd = null)
    {
        $language = Language::getOne($language_id);
        if($type == 'created') {
            $typeArray = ['created', 'words'];
            $words1 = 'добавления новых фраз';
            $words2 = 'добавления новых слов';
            $color = [
                'color1' => 'rgb(255, 99, 132)',
                'color2' => 'rgb(153, 102, 255)',
                'background1' => 'rgba(255, 99, 132, 0.2)',
                'background2' => 'rgba(153, 102, 255, 0.2)',
            ];
        }

        if($type == 'repeated') {
            $typeArray = ['repeated', 'readed'];
            $words1 = 'повторения фраз';
            $words2 = 'чтения фраз';
            $color = [
                'color1' => 'rgb(54, 162, 235)',
                'color2' => 'rgb(255, 159, 64)',
                'background1' => 'rgba(54, 162, 235, 0.2)',
                'background2' => 'rgba(255, 159, 64, 0.2)',
            ];
        }
        $all = false;

        if($period == 100) {
            $step = 7;
            $start = date('Y-m-d', strtotime($period . ' days ago', time()));
            $end = date('Y-m-d', time());
        }

        if($period <= 25) {
            $period = $period - 1;
            $step = 1;
            $start = date('Y-m-d', strtotime($period . ' days ago', time()));
            $end = date('Y-m-d', time());
        }

        if($period == 500) {
           $val = Statistics::calculateStartAndEnd($language_id);
           $start = $val['start'];
           $end = $val['end'];
           $step = $val['period'];
           $all = true;
        }


        if($startAdd) {
            $start = date('Y-m-d', strtotime($period . ' days ago', strtotime($startAdd)));
            $end = $startAdd;
        }

        $array1 = $this->getArraysForDiagrams($start, $end, $language_id, $typeArray[0], $step, $all);
        $array2 = $this->getArraysForDiagrams($start, $end, $language_id, $typeArray[1], $step, $all);

        $count1 = $array1['count'];
        $count2 = $array2['count'];
        $dates1 = $array1['date'];
        $dates2 = $array2['date'];
        $countProgress1 = $this->arrayProgress($array1['count']);
        $countProgress2 = $this->arrayProgress($array2['count']);

        if($period <= 25) {
            $period = $period + 1;
        }

        $scheduleValue = [
            'name1' => 'Прогрессивный график '.$words1.' за ' . $period . ' последних дней',
            'name2' => 'Прогрессивный график '.$words2.' за ' . $period . ' последних дней',
            'progressName1' => 'График ' .$words1. ' за ' . $period . ' последних дней',
            'progressName2' => 'График ' .$words2. ' за ' . $period . ' последних дней',
            'title' => "Статистика $words1 и $words2 за $period последних дней",
        ];

        if($period == 500) {
            $scheduleValue = [
                'name1' => 'Прогрессивный график '.$words1.' за все время изучения',
                'name2' => 'Прогрессивный график '.$words2.' за все время изучения',
                'progressName1' => 'График ' .$words1. ' за все время изучения',
                'progressName2' => 'График ' .$words2. ' за все время изучения',
                'title' => "Статистика $words1 и $words2 за все время изучения",
            ];
        }

        if($startAdd == null) {
            $startAdd = $start;
        } else {
            $startAdd = $start;
        }

        $middleDays = 30;
        $maxDays = 100;
        return view('statistic.diagram-small',
            compact('countProgress1', 'countProgress2', 'count1', 'count2',
                'dates1', 'dates2', 'scheduleValue', 'period', 'language_id', 'language', 'type',
                'color', 'startAdd', 'middleDays', 'maxDays'));
    }


    public function getDiagramTime($language_id, $period, $startAdd = null)
    {
        $language = Language::getOne($language_id);

        $color = [
            'color1' => '#ff4500',
            'background1' => '#ffdead',
        ];

        if($period == 100) {
            $step = 7;
            $start = date('Y-m-d', strtotime($period . ' days ago', time()));
            $end = date('Y-m-d', time());
        }

        if($period <= 25) {
            $period = $period - 1;
            $step = 1;
            $start = date('Y-m-d', strtotime($period . ' days ago', time()));
            $end = date('Y-m-d', time());
        }
        $all = false;
        if($period == 500) {
            $val = Statistics::calculateStartAndEnd($language_id);
            $start = $val['start'];
            $end = $val['end'];
            $step = $val['period'];
            $all = true;
        }

        if($startAdd) {
            $start = date('Y-m-d', strtotime($period . ' days ago', strtotime($startAdd)));
            $end = $startAdd;
        }

        $array1 = Time::getArraysForDiagrams($start, $end, $language_id, $step, $all);

        $count1 = $array1['count'];
        $dates1 = $array1['date'];
        $middle = $array1['middle'];

//        dd(Time::getHMS($middle));

        $countProgress1 = $this->arrayProgress($array1['count']);


        if($period <= 25) {
            $period = $period + 1;
        }

        $scheduleValue = [
            'name1' => 'Прогрессивный график затраченного времени за ' . $period . ' последних дней',
            'progressName1' => 'График затраченного времени за ' . $period . ' последних дней',
            'title' => "Статистика затраченного времени за $period последних дней",
        ];

        if($period == 500) {
            $scheduleValue = [
                'name1' => 'Прогрессивный график затраченного времени за все время изучения',
                'progressName1' => 'График затраченного времени за все время изучения',
                'title' => "Статистика затраченного времени за все время изучения",
            ];
        }

        if($startAdd == null) {
            $startAdd = $start;
        } else {
            $startAdd = $start;
        }

        $middleDays = 30;
        $maxDays = 100;
        return view('statistic.diagram-time',
            compact('countProgress1', 'count1', 'dates1', 'scheduleValue', 'period', 'language_id',
                'language', 'color', 'startAdd', 'middleDays', 'maxDays', 'middle'));
    }


    private function arrayProgress($array)
    {
        $progress = [];
        for ($i = 0; $i < count($array); $i++):
            if ($i === 0) {
                $progress[$i] = $array[$i];
            } else {
                $progress[$i] = $array[$i] + $progress[$i - 1];
            }
        endfor;
            return $progress;
    }


    private function getArraysForDiagrams($start, $end, $language_id, $type, $daysAdd, $all)
    {
        $i = $start;
        $countArray = [];
        $dateArray = [];
        $num = 0;
        while ($i <= $end):
            $nextDate = date('Y-m-d', strtotime('+' . $daysAdd . ' days', strtotime($i)));
            if($num > 0 && $daysAdd > 1) $i = date('Y-m-d', strtotime('+1 day', strtotime($i)));
//            dd($i);
            if($daysAdd === 1) {
                $items = Statistics::where('user_id', auth()->id())->where('language_id', '=', $language_id)
                    ->where('date', '=', $i)->get();
            } else {
                $items = Statistics::where('user_id', auth()->id())->where('language_id', '=', $language_id)
                    ->whereBetween('date', [$i, $nextDate])->get();
            }

            $countArray[$num] = $items->sum($type);
            $dateArray[$num] = date('dM', strtotime($i));
            if($all) {
                $dateArray[$num] = date('d.My', strtotime($i));
            }

            $i = $nextDate;
            $num++;
        endwhile;

        return [
            'count' => $countArray,
            'date' => $dateArray,
        ];
    }


    public function addingWords($language_id)
    {
        $dictionary = Dictionary::getForLanguageAll($language_id);
        $lastWord = $dictionary[0];

        // Дата 1 записи в словаре
        $language = Language::getOne($language_id);

        $firstDate = date('Y-m-d', strtotime($lastWord->created_at));
        $firstDayWeek = date('w', strtotime($lastWord->created_at));

        //Дата начала выборки
        $startDate = $firstDate;
        if ($firstDayWeek != 1) {
            $startDate = date('Y-m-d', strtotime("last Monday", strtotime($firstDate)));
        }

        //Сегодняшняя дата
        $currentDate = date('Y-m-d', time());

        $i = $startDate;
        $countWordsForWeek = [];
        $dateArray = [];
        $num = 0;
        while ($i <= $currentDate):
            $nexDate = date('Y-m-d', strtotime("+1 week", strtotime($i)));
            $from = $i . ' 00:00:00';
            $before = $nexDate . ' 00:00:00';
            $count = $dictionary->whereBetween('created_at', [$from, $before])->count();
            $countWordsForWeek[$num] = $count;
            if (isset($countWordsForWeek[$num - 1])) {
                $countWordsForWeek[$num] = $count + $countWordsForWeek[$num - 1];
            }
            $dateArray[$num] = $nexDate;

            $i = $nexDate;
            $num++;
        endwhile;

        $countArray = count($dateArray);
        if ($countArray > 0) {
            $dateArray[$countArray - 1] = $currentDate;
        }

        return view('statistic.add-words', compact('dateArray', 'countWordsForWeek', 'language'));
    }
}
