<?php

namespace App\Models;

use App\Models\phrases\Phrase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;
    protected $table = 'sections';


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function language()
    {
        return $this->belongsTo(Language::class);
    }


    public function sections()
    {
        return $this->hasMany(self::class, 'parent_id');
    }


    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }


    public static function getAllRoot($language_id)
    {
        return self::where('user_id', auth()->id())
            ->where('parent_id', '=', null)
            ->where('language_id', '=', $language_id)
            ->get();
    }


    public static function getOne($id)
    {
        return self::where('user_id', auth()->id())
            ->where('id', '=', $id)
            ->first();
    }


    public function getBreadcrumb($section_id)
    {
        $section = $this->where('id', $section_id)->first();
        if(!$section->parent_id) {
            return '';
        } else {
            return $this->getValueForBreadCrumbs($section);
        }
    }


    private function getValueForBreadCrumbs($section)
    {
        $text = '';
        foreach($this->getParentIds($section->id) as $id)
        {
            $sect = $this->where('id', $id)->first();
            $text .= '<li class="breadcrumb-item"><a href="'.route('section.show', ['section' => $sect->id]).'">'.$sect->title.'</a></li> ';
        }

        return $text;
    }


    private function getParentIds($id)
    {
        $section = $this->where('id', $id)->first();
        $arr[] = $section->parent->id;
        if(isset($section->parent->parent->id)) {
            $arr[] = $section->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->parent->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->parent->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->parent->parent->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->id;
        }
        if(isset($section->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->id)) {
            $arr[] = $section->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->parent->id;
        }


        return array_reverse($arr);

    }





    public function sectionIds($section, $ids=[])
    {
        global $ids;
        if(!$section->sections->isEmpty()) {
            foreach ($section->sections as $item) {
                $ids[] += $item->id;
                if(!$item->sections->isEmpty()) {
                    $this->sectionIds($item, $ids);
                }
            }
        } else {
            $ids = [0 => $section->id];
        }
        return $ids;
    }


    public function countPhrases()
    {
        $model = Phrase::getModel();
        $section_id = $this->sectionIds($this);
        if($section_id) {
            return $model::whereIn('section_id', $section_id)->get()->count();
        } else {
            return $model::where('section_id', $this->id)->get()->count();
        }

    }


    public static function getSections($ids)
    {
        $sectionsIds = explode(',', $ids);
        $revers =array_reverse($sectionsIds);
        $arraySections = [];
        foreach($revers as $idTime) {
            $id = explode('/', $idTime);
            $time = explode('/', $idTime)[1];
            $section = self::where('id', $id[0])->first();
            if($section) {
                $section->status = $id[1];
                array_unshift($arraySections, $section);
            }

        }
        $sections = collect($arraySections);
        return $sections;
    }






}














