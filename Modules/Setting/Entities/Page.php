<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;

class Page extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'pages';
    public $timestamps = true;


    public $searchRelationShip  = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name','description'];
    public static $rules = [
        'order' => 'required|numeric|unique:pages',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public static function getValidationRules()
    {
        return self::$rules;
    }

    public static function translationKey(){
        return ['name','description'];
    }

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category');
    }

    public function name()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'name')
            ->where('language_id' ,languageId());
    }

    public function nameValue()
    {
         $names=$this->morphone(Translation::class, 'category')
            ->where('key' ,'name')->get();
        return $names->pluck('value','language.code')->toArray();
    }

    public function descriptionValue()
    {
        $descriptions=$this->morphone(Translation::class, 'category')
            ->where('key' ,'description')->get();
        return $descriptions->pluck('value','language.code')->toArray();
    }

    public function description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'description')
            ->where('language_id' ,languageId());
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($gender) {
            $gender->translation()->delete();
        });

    }
}
