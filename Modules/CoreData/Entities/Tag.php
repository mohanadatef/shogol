<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;

class Tag extends Model
{


    protected $fillable = [
        'status',  'category_id'
    ];
    protected $table = 'tags';

    public $timestamps = true;
    public $searchRelationShip  = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    public static $rules = [
        'category_id' => 'required|exists:categories,id',
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
    public $searchConfig = [
        'name'=>'like',
    ];

    public static function translationKey()
    {
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->hasMany(User::Class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($tag) {
            $tag->translation()->delete();
        });

    }
}
