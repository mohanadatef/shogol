<?php

namespace Modules\CoreData\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\Skill;
use Modules\Basic\Entities\Translation;

class Level extends Model
{
    protected $fillable = [
        'status','order','level'
    ];
    protected $table = 'levels';
    public $timestamps = true;
    public $searchRelationShip = [];


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    public static $rules = [
        'level' => 'numeric|unique:levels',
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

    public function skill()
    {
        return $this->hasMany(Skill::Class);
    }
}
