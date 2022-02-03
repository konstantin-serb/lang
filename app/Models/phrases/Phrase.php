<?php

namespace App\Models\phrases;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phrase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;


    public static function getModel()
    {
        $key = auth()->user()->key;
        $model = 'App\Models\phrases\Phrase' . $key;
        return new $model();
    }

    public static function getPhrasesForSection($section_id, $sort='desc')
    {
        $model = self::getModel();
        return $model::where('section_id', $section_id)->orderBy('id', $sort)->get();
    }

}
