<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Language;
use App\Models\phrases\Phrase;
use App\Models\Statistics;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $languages = Language::getAll();

        return view('statistic.index', compact('languages'));
    }


    public function temp()
    {
        //        ==========================================================
//        $dictionary = Dictionary::getForLanguageAll(1);
//        foreach($dictionary as $item):
//            $date = date('Y-m-d', strtotime($item->created_at));
//            $statistic = Statistics::firstOrNew(['user_id' => auth()->id(),
//                'language_id' => 1, 'date' => $date]);
//            $statistic->words++;
//            $statistic->save();
//        endforeach;
//
//        return 'yes';
//        ----------------------------------------------------------

        $model = Phrase::getModel();
        $phrases = $model->where('user_id', auth()->id())
            ->where('language_id', '=', 1)
            ->orderBy('created_at', 'asc')
            ->get();
        $startDate = date('Y-m-d', strtotime($phrases[0]->created_at));
        $lastPhrase = $phrases[count($phrases) - 1];

        // Цикл для занесения данных количества фраз в таблицу статистики
        $i = $startDate;
        $endDate = date('Y-m-d', strtotime($phrases[count($phrases) - 1]->created_at));
        $sum = 0;
        while ($i <= $endDate):
            $from = $i . ' 00:00:00';
            $to = $i . ' 23:59:59';
            $countPhrases = $model->whereBetween('created_at', [$from, $to])->count();
            if ($countPhrases > 0) {
                $statistic = Statistics::firstOrNew(['user_id' => auth()->id(),
                    'language_id' => 1, 'date' => $i]);
                $statistic->created = $countPhrases;
                $statistic->save();
            }
            // Приращение цикла
            $sum = $sum + $countPhrases;
            $i = date('Y-m-d', strtotime("+1 day", strtotime($i)));
        endwhile;


        $statistics = Statistics::all();
        dd($statistics->sum('created'));

    }


    public function getDiagramType1($language_id, $type)
    {
        $period = 100;
        $start = date('Y-m-d', strtotime($period . ' days ago', time()));
        $end = date('Y-m-d', time());

        $arraysCreated = $this->getArraysForDiagrams($start, $end, $language_id, $type, 7);
        $count = $arraysCreated['count'];
        $dates = $arraysCreated['date'];
        $countProgress = $this->arrayProgress($arraysCreated['count']);

        $scheduleValue = [
            'name' => 'Прогрессивный график добавления новых фраз за ' . $period . ' дней',
            'progressName' => 'График добавления новых фраз за ' . $period . ' дней',

        ];

        return view('statistic.diagram-1', compact('countProgress', 'count', 'dates', 'scheduleValue', 'period'));
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


    private function getArraysForDiagrams($start, $end, $language_id, $type, $daysAdd)
    {
        $i = $start;
        $countArray = [];
        $dateArray = [];
        $num = 0;
        while ($i <= $end):
            $nextDate = date('Y-m-d', strtotime('+' . $daysAdd . ' days', strtotime($i)));
            if($num > 0) $i = date('Y-m-d', strtotime('+1 day', strtotime($i)));

            $items = Statistics::where('user_id', auth()->id())->where('language_id', '=', $language_id)
                ->whereBetween('date', [$i, $nextDate])->get();

            $countArray[$num] = $items->sum($type);
            $dateArray[$num] = $nextDate;

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
//            dd($from, $before);
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
