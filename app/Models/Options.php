<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    use HasFactory;

    protected $table = 'options';
    protected $guarded = false;
    public $timestamps = false;

    public static function getDefaultLanguage()
    {
        $options = self::getOptions();
        if($options) {
            $languageDefault = Language::getOne($options->default_language_id);
            return $languageDefault;
        } else {
            return false;
        }
    }

    public static function addPhrase($id)
    {
        $countMembers = 100;
        $options = self::getOptions();
        $array = [];
        $data = $id . '/' . time();
        if($options->phrases) {
            $array = explode(',', $options->phrases);
            array_unshift($array, $data);
        } else {
            array_unshift($array, $data);
        }

        $string = self::createString($array, $countMembers);
        $options->phrases = $string;
        if($options->save()) {
            return true;
        }
    }


    public static function getOptions()
    {
        $options = self::where('user_id', auth()->id())->first();
        return $options;
    }


    public static function setLearnHistory($ids, $task)
    {
        $options = self::getOptions();
        $countMembers = 10;
        if($task == 1) {
            $remember = 'last_sections_learn';
        } elseif($task == 2) {
            $remember = 'last_sections_read';
        } elseif($task == 3) {
            $remember = 'last_section_add';
        }

        if($options->$remember) {
            //Если ячейка базы данных не пуста
            $historyArray = explode(',', $options->$remember);
            if(is_array($ids)) {
                foreach ($ids as $id) {
                    foreach ($historyArray as $key => $value) {
                        $oldId = (explode('/', $value))[0];
                        if($oldId == $id) {
                            unset($historyArray[$key]);
                        }
                    }
                    $data = $id . '/' . time();
                    array_unshift($historyArray, $data);
                }
            } else {
                foreach ($historyArray as $key => $value) {
                    $oldId = (explode('/', $value))[0];
                    if($oldId == $ids) {
                        unset($historyArray[$key]);
                    }
                }
                $data = $ids . '/' . time();
                array_unshift($historyArray, $data);
            }

        } else {
            // Если ячейка пуста...
            $historyArray = self::createArray($ids);
        }

        $options->$remember = self::createString($historyArray, $countMembers);
        if($options->save()) {
            return true;
        }
    }


    public function createArray($ids)
    {
        $historyArray = [];
        if(is_array($ids)) {
            foreach($ids as $id) {
                $data = $id . '/' . time();
                array_unshift($historyArray, $data);
            }
            $historyArray = array_reverse($historyArray);
        } else {
            $data = $ids . '/' . time();
            array_unshift($historyArray, $data);
        }
        return $historyArray;
    }


    function createString($array, $count)
    {
        //Проверяем длину масссива
        if(count($array) > $count) {
            // Если длина массива длиннее чему нужно, обрезаем массив
            $newArray = array_slice($array, 0,  $count);
        } else {
            //Усли меньше..
            $newArray = $array;
        }

        //Преобразовываем массив в строку
        $string = implode(',', $newArray);
        return $string;
    }



}















