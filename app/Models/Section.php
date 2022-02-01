<?php

namespace App\Models;

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
            $section = $this->where('id', $id)->first();
            $text .= '<li class="breadcrumb-item"><a href="'.route('section.show', ['section' => $section->id]).'">'.$section->title.'</a></li> ';
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

}














