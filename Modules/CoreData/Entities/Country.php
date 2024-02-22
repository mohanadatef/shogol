<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;
use Modules\Task\Entities\Task;

class Country extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'countries';
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
    public $searchConfig = [
        'name'=>'like',
    ];
    public static $rules = [
        'order' => 'required|numeric|unique:countries',
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

    public function state()

    {
        return $this->hasMany(State::class);
    }

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }
    public function area()
    {
        return $this->hasMany(Country::class);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($country) {
            $country->translation()->delete();
        });


    }
}
