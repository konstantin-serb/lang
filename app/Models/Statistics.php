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


    public static function getRepeatedToday()
    {
        $statistics  = self::where('user_id', auth()->id())
            ->where('date', '=', date('Y-m-d'))
            ->first();

        if(isset($statistics->repeated)) {
            return $statistics->repeated;
        } else {
            return 0;
        }
    }


    public static function getCreatedToday()
    {
        $statistics  = self::where('user_id', auth()->id())
            ->where('date', '=', date('Y-m-d'))
            ->first();

        if(isset($statistics->created)) {
            return $statistics->created;
        } else {
            return 0;
        }
    }
}
