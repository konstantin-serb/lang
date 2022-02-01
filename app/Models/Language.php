<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'languages';
    protected $guarded = false;
//    public $timestamps = false;

    public function sections()
    {
        return $this->hasMany(Section::class);
    }


    public function user()
    {
        $this->belongsTo(User::class);
    }

    public static function getAll()
    {
        return self::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
    }


    public static function getOne($id)
    {
        return self::where('user_id', auth()->id())->where('id', '=', $id)->first();
    }



}
