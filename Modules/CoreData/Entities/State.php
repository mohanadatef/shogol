<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;
use Modules\Task\Entities\Task;

class State extends Model
{
    protected $fillable = [
        'status', 'order', 'city_id', 'country_id'
    ];
    protected $table = 'states';
    public $timestamps = true;
    public $searchRelationShip = [];



    public static $rules = [
        'order' => 'required|numeric|unique:cities',
        'country_id' => 'required|exists:countries,id',
        'city_id' => 'required|exists:cities,id',
    ];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    public static function getValidationRules()
    {
        return self::$rules;
    }
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function user()
    {
        return $this->hasMany(User::Class);
    }

    public function task()
    {
        return $this->hasMany(Task::Class);
    }
    public function area()
    {
        return $this->hasMany(Area::Class);
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($state) {
            $state->translation()->delete();
        });

    }

}
