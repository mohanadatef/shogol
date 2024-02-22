<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Media;
use Modules\Basic\Entities\Translation;

class Nationality extends Model
{
    protected $fillable = [
        'status','order','code'
    ];
    protected $table = 'nationalities';
    public $timestamps = true;
    public $searchRelationShip = [];


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    public static $rules = [
        'order' => 'required|numeric|unique:nationalities',
        'logo' => 'image|mimes:jpg,jpeg,png,gif',
        'code' => 'required|min:2|max:5|unique:nationalities',
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

    public function user()
    {
        return $this->hasMany(User::Class);
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'category');
    }

    public function logo()
    {
        return $this->media()->whereType(mediaType()['lm']);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($nationalty) {
            $nationalty->translation()->delete();
            $nationalty->media()->delete();
        });

    }
}
