<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

    protected $table = 'dictionaries';
    protected $guarded = false;


    public static function getAll()
    {
        return self::where('user_id', auth()->id())
            ->orderBy('word')
            ->get();
    }


    public static function getOne($id)
    {
        return self::where('user_id', auth()->id())
            ->where('id', '=', $id)->first();
    }


    public static function getAllForLanguage($language_id)
    {
        return self::where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
            ->where('status', '=', 1)
            ->orderBy('word')
            ->count();
    }


    public static function getWordsToday($language_id)
    {
        $dateToday = date('Y-m-d');
        return self::where('user_id', auth()->id())
            ->where('language_id', '=', $language_id)
            ->whereDate('created_at', '=', $dateToday)
            ->orderBy('created_at')
            ->get();
    }
}
