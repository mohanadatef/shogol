<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;
use Modules\Task\Entities\Task;

class City extends Model
{


    protected $fillable = [
        'status', 'order', 'country_id'
    ];
    protected $table = 'cities';

    public $timestamps = true;
    public $searchRelationShip = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    public static $rules = [
        'order' => 'required|numeric|unique:cities',
        'country_id' => 'required|exists:countries,id',
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = ['name'=>'like'];
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

    public function state()
    {
        return $this->hasMany(state::class);
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
        return $this->hasMany(Area::class);
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($city) {
            $city->translation()->delete();
        });


    }
}
