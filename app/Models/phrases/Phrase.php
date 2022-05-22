<?php

namespace App\Models\phrases;

use App\Models\Language;
use App\Models\Section;
use App\Models\Statistics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phrase extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected $guarded = false;


    public function section()
    {
        return $this->belongsTo(Section::class);
    }


    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public static function getModel()
    {
        $key = auth()->user()->key;
        $model = 'App\Models\phrases\Phrase' . $key;
        return new $model();
    }


    public function getCountReading()
    {
        if($this->reading > 0) {
            return $this->reading;
        } else {
            return 0;
        }
    }


    public function getCountLearning()
    {
        if($this->count > 0) {
            return $this->count;
        } else {
            return 0;
        }
    }



    public static function getPhrasesForSectionSingle($section_id, $sort = 'desc')
    {
        $model = self::getModel();
        return $model::where('section_id', $section_id)->orderBy('id', $sort)->get();

    }


    public static function getOne($id)
    {
        $model = self::getModel();
        return $model::where('user_id', auth()->id())->where('id', '=', $id)->first();
    }

    //Получение всех фраз по языку. Сортировка по Id
    public static function getAllPhrases($language_id)
    {
        $model = self::getModel();
        $phrases = $model->where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
            ->orderBy('id')
            ->get();
        return $phrases;
    }


    public static function getCountPhrased($language_id)
    {
        $phrases = self::getAllPhrases($language_id);
        return $phrases->count();
    }


    public static function countSumLearning($language_id)
    {
        $phrases = self::getAllPhrases($language_id);
        return $phrases->sum('count');
    }

    public static function countSumReading($language_id)
    {
        $phrases = self::getAllPhrases($language_id);
        return $phrases->sum('reading');
    }


    public static function getPhrases($sections_id, $complexity)
    {
        $model = self::getModel();
        if(is_array($sections_id)) {
            if($complexity == 1) {
            return $model::whereIn('section_id', $sections_id)->where('status', '=', 1)->orderBy('id')->get();
                } elseif($complexity ==2) {
                return $model::whereIn('section_id', $sections_id)->where('complexity', '=', 1)
                    ->where('status', '=', 1)->orderBy('id')->get();
            } elseif($complexity == 3) {
                return $model::whereIn('section_id', $sections_id)->where('complexity', '=', 2)
                    ->where('status', '=', 1)->orderBy('id')->get();
            } elseif ($complexity == 4) {
                return $model::whereIn('section_id', $sections_id)->where('complexity', '=', 3)
                    ->where('status', '=', 1)->orderBy('id')->get();
            } elseif ($complexity == 5) {
                return $model::whereIn('section_id', $sections_id)->where('complexity', '>', 1)
                    ->where('status', '=', 1)->orderBy('id')->get();
            }
        } else {
            if($complexity == 1) {
                return $model::where('section_id', $sections_id)->where('status', '=', 1)->orderBy('id')->get();
            } elseif($complexity ==2) {
                return $model::where('section_id', $sections_id)->where('complexity', '=', 1)
                    ->where('status', '=', 1)->orderBy('id')->get();
            } elseif($complexity == 3) {
                return $model::where('section_id', $sections_id)->where('complexity', '=', 2)
                    ->where('status', '=', 1)->orderBy('id')->get();
            } elseif ($complexity == 4) {
                return $model::where('section_id', $sections_id)->where('complexity', '=', 3)
                    ->where('status', '=', 1)->orderBy('id')->get();
            } elseif ($complexity == 5) {
                return $model::where('section_id', $sections_id)->where('complexity', '>', 1)
                    ->where('status', '=', 1)->orderBy('id')->get();
            }
        }
    }

    public static function getFavorite($languages_id)
    {
        $model = self::getModel();
        $phrases = $model->where('user_id', '=', auth()->id())
            ->where('language_id', '=', $languages_id)
            ->where('type', '=', 1)
            ->where('status', '=', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
        return $phrases;
    }

    public static function clearFavorite($languages_id)
    {
        $favorites = self::getFavorite($languages_id);
        foreach($favorites as $phrase) {
            $phrase->type = null;
            $phrase->save();
        }
        return true;
    }


    public function getPhrasesMix($ids)
    {
        $model = self::getModel();
        $phrased = $model->where('user_id', '=', auth()->id())->whereIn('id', $ids)->where('status', '=', 1)->get();

        return $phrased;
    }


    public static function getPhrasesForSearch($options)
    {
        $model = self::getModel();
        if($options['task'] == 1) {
            $task = 'count';
        } else {
            $task = 'reading';
        }

        if($options['complexity'] == 1) {
            $equals = '>';
            $complexity = 0;
        } elseif($options['complexity'] == 2) {
            $equals = '=';
            $complexity = 1;
        } elseif($options['complexity'] == 3) {
            $equals = '=';
            $complexity = 2;
        } elseif($options['complexity'] == 4) {
            $equals = '=';
            $complexity = 3;
        } elseif($options['complexity'] == 2) {
            $equals = '>';
            $complexity = 1;
        }

        if($options['order'] == 1) {
            $order = 'asc';
        } elseif($options['order'] == 2) {
            $order = 'desc';
        } elseif($options['order'] == 3) {
            $task = 'id';
            $order = 'desc';
        } elseif($options['order'] == 4) {
            $task = 'id';
            $order = 'asc';
        } elseif($options['order'] == 5) {
            $result = $model->where('language_id', $options['language_id'])
                ->where('complexity', $equals, $complexity)
                ->where('status', '=', 1)
                ->inRandomOrder()
                ->limit($options['count'])
                ->get();
            return $result;
        }


        $result = $model->where('language_id', $options['language_id'])
            ->where('status', '=', 1)
            ->where('complexity', $equals, $complexity)
            ->orderBy($task, $order)
            ->limit($options['count'])
            ->offset($options['offset'])
            ->get();
            return $result;
        }

    public static function getNullable()
    {
        $model = self::getModel();
        return $model::where('user_id', auth()->id())
        ->where('count', '=', 0)->orderBy('id')->get();
    }


    public static function getPhrasesForSection($section_id, $sort = 'desc')
    {
        $section = Section::getOne($section_id);
        $model = self::getModel();

        if (!$section->sections->isEmpty()) {
            $section_id = $section->sectionIds($section);
            return $model::whereIn('section_id', $section_id)->orderBy('id', $sort)->get();
        } else {
            return $model::where('section_id', $section_id)->orderBy('id', $sort)->get();
        }
    }


    public static function getPhrasesForSectionHard($section_id, $sort = 'asc')
    {
        $section = Section::getOne($section_id);
        $model = self::getModel();

        if (!$section->sections->isEmpty()) {
            $section_id = $section->sectionIds($section);
            return $model::whereIn('section_id', $section_id)
                ->where('complexity', '=', 3)
                ->where('status', '=', 1)
                ->orderBy('id', $sort)->get();
        } else {
            return $model::where('section_id', $section_id)
                ->where('complexity', '=', 3)
                ->where('status', '=', 1)
                ->orderBy('id', $sort)->get();
        }

    }


    public static function getPhrasesForSectionNoEasy($section_id, $sort = 'asc')
    {
        $section = Section::getOne($section_id);
        $model = self::getModel();

        if (!$section->sections->isEmpty()) {
            $section_id = $section->sectionIds($section);
            return $model::whereIn('section_id', $section_id)
                ->where('complexity', '!=', 1)
                ->where('status', '=', 1)
                ->orderBy('id', $sort)->get();
        } else {
            return $model::where('section_id', $section_id)
                ->where('complexity', '!=', 1)
                ->where('status', '=', 1)
                ->orderBy('id', $sort)->get();
        }
    }


    public static function getPhrasesForHomePage($string)
    {
        $model = self::getModel();
        $ids = explode(',', $string);
        $revers =array_reverse($ids);
        $arrayPhrases = [];
        foreach($revers as $idTime) {
            $id = explode('/', $idTime);
            $time = $id[1];
            $phrase = $model::where('id', $id[0])->first();
            if($phrase) {
                $phrase->user_id = $time;
                array_unshift($arrayPhrases, $phrase);
            }
        }
        $phrases = collect($arrayPhrases);
        return $phrases;
    }


    public function addBTags($string, $word)
    {
        //Количество букв в строке
        $countLetters = iconv_strlen($string, 'UTF-8');

        //Количество букв в слове
        $countLetWord = iconv_strlen($word, 'UTF-8');

        //Номер первого вхождения слова в строке
        $positionWord = stripos($string, $word);

        if($positionWord !== false) {
            $firstPath = mb_substr($string, 0, $positionWord);
            $lastPath = mb_substr($string, $positionWord + $countLetWord, $countLetters);
            $centerPath = mb_substr($string, $positionWord, $countLetWord);

            $result = $firstPath . '<b style="color:blue;">' . $centerPath . '</b>' . $lastPath;

            return $result;
        }
    }


    public static function preparePhrase($phrase)
    {
        $array = explode(' ', $phrase);
        foreach($array as $key => $value):
            if($value == '' || $value == ' ' ):
                unset($array[$key]);
            endif;
        endforeach;
        $prepare = implode(' ', $array);
        return $prepare;
    }


    public static function phrasesSectionDelete($id)
    {
        $phrases = self::getPhrasesForSection($id);
        foreach ($phrases as $phrase) {
            $statistics = Statistics::firstOrNew(['user_id' => auth()->id(),
                'language_id' => $phrase->language_id,
                'date' => date('Y-m-d', strtotime($phrase->created_at))]);
            $statistics->created = $statistics->created - 1;
            $statistics->save();

            $phrase->delete();
        }
    }

}
