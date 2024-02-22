<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Basic\Entities\Translation;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'order', 'city_id', 'country_id','state_id'
    ];
    protected $table = 'areas';
    public $timestamps = true;
    public $searchRelationShip = [];

    protected $with = ['name'];

    public static $rules = [
        'order' => 'nullable|numeric',
        'country_id' => 'required|exists:countries,id',
        'city_id' => 'required|exists:cities,id',
        'state_id' => 'required|exists:states,id',
    ];

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

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public static function getValidationRules()
    {
        return self::$rules;
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($area) {
            $area->translation()->delete();
        });

    }
}
