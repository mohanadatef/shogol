<?php

namespace Modules\Basic\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomTranslation extends Model
{
    protected $fillable = [
        'status','key'
    ];
    protected $table = 'custom_translations';
    public $timestamps = true;



    public $searchRelationShip  = [];
    public static $rules = [
        'key' => 'required|string|unique:customTranslations',
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
    protected $with = ['value'];
    public static function getValidationRules()
    {
        return self::$rules;
    }

    public static function translationKey(){
        return ['value'];
    }

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category');
    }

    public function value()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'value')
            ->where('language_id' ,languageId());
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($customTranslation) {
            $customTranslation->translation()->delete();
        });

    }
}
