<?php

namespace App\Models\phrases;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phrase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;


    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public static function getModel()
    {
        $key = auth()->user()->key;
        $model = 'App\Models\phrases\Phrase' . $key;
        return new $model();
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
                ->orderBy('id', $sort)->get();
        } else {
            return $model::where('section_id', $section_id)
                ->where('complexity', '=', 3)
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
                ->orderBy('id', $sort)->get();
        } else {
            return $model::where('section_id', $section_id)
                ->where('complexity', '!=', 1)
                ->orderBy('id', $sort)->get();
        }
    }

}
