<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;

class JobName extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'job_names';
    public $timestamps = true;
    public $searchRelationShip = [];


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    public static $rules = [
        'order' => 'required|numeric|unique:job_names',
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

    public function user()
    {
        return $this->hasMany(User::Class);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($job_name) {
            $job_name->translation()->delete();
        });

    }
}
