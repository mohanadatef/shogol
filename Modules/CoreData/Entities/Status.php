<?php

namespace Modules\CoreData\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;
use Modules\Task\Entities\Ad;
use Modules\Task\Entities\Offer;
use Modules\Task\Entities\Task;

class Status extends Model
{

    protected $fillable = [
        'status','order','offer_owner_color','task_owner_color'
    ];
    protected $table = 'status';
    public $timestamps = true;
    public $searchRelationShip = [];


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    public static $rules = [];
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
        return ['name','task_owner','offer_owner','task_owner_description','offer_owner_description'];
    }

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category');
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function ad()
    {
        return $this->hasMany(Ad::class);
    }

  public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function name()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'name')
            ->where('language_id' ,languageId());
    }

    public function nameValue()
    {
        $names = $this->morphone(Translation::class, 'category')
            ->where('key', 'name')->get();
        return $names->pluck('value', 'language.code')->toArray();
    }

    public function task_owner()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'task_owner')
            ->where('language_id' ,languageId());
    }

    public function task_ownerValue()
    {
        $names = $this->morphone(Translation::class, 'category')
            ->where('key', 'task_owner')->get();
        return $names->pluck('value', 'language.code')->toArray();
    }

    public function offer_owner()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'offer_owner')
            ->where('language_id' ,languageId());
    }

    public function offer_ownerValue()
    {
        $names = $this->morphone(Translation::class, 'category')
            ->where('key', 'offer_owner')->get();
        return $names->pluck('value', 'language.code')->toArray();
    }
    public function task_owner_description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'task_owner_description')
            ->where('language_id' ,languageId());
    }

    public function task_owner_descriptionValue()
    {
        $names = $this->morphone(Translation::class, 'category')
            ->where('key', 'task_owner_description')->get();
        return $names->pluck('value', 'language.code')->toArray();
    }

    public function offer_owner_description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'offer_owner_description')
            ->where('language_id' ,languageId());
    }

    public function offer_owner_descriptionValue()
    {
        $names = $this->morphone(Translation::class, 'category')
            ->where('key', 'offer_owner_description')->get();
        return $names->pluck('value', 'language.code')->toArray();
    }

}
