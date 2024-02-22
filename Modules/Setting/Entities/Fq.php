<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;

class Fq extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'fqs';
    public $timestamps = true;



    public $searchRelationShip  = [];
    public static $rules = [
        'order' => 'required|numeric|unique:fqs',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['answer','question'];
    public static function getValidationRules()
    {
        return self::$rules;
    }

    public static function translationKey(){
        return ['answer','question'];
    }

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category');
    }

    public function answer()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'answer')
            ->where('language_id' ,languageId());
    }

    public function answerValue()
    {
        $answers=$this->morphone(Translation::class, 'category')
            ->where('key' ,'answer')->get();
        return $answers->pluck('value','language.code')->toArray();
    }

    public function questionValue()
    {
        $questions=$this->morphone(Translation::class, 'category')
            ->where('key' ,'question')->get();
        return $questions->pluck('value','language.code')->toArray();
    }

    public function question()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'question')
            ->where('language_id' ,languageId());
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($gender) {
            $gender->translation()->delete();
        });

    }
}
