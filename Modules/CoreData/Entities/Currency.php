<?php

namespace Modules\CoreData\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;
use Modules\Task\Entities\Ad;
use Modules\Task\Entities\Task;

class Currency extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'currencies';
    public $timestamps = true;
    public $searchRelationShip = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public static $rules = [
        'order' => 'required|numeric|unique:currencies',
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }

    public static function translationKey(){
        return ['name'];
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

    public function ad()
    {
        return $this->hasMany(Ad::Class);
    }

    public function task()
    {
        return $this->hasMany(Task::Class);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($country) {
            $country->translation()->delete();
        });


    }
}
