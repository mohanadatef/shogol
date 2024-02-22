<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Comment;
use Modules\Basic\Entities\Translation;

class Cancellation extends Model
{
    protected $fillable = [
        'status', 'order','parent_id'
    ];
    protected $table = 'cancellations';
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
        'order' => 'required|numeric|unique:cancellations',
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }

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
            ->where('key', 'name')
            ->where('language_id', languageId());
    }

    public function children()
    {
        return $this->hasMany(Cancellation::class, 'parent_id');
    }

    public function parents()
    {
        return $this->belongsTo(Cancellation::class, 'parent_id',  'id');
    }

    public function parentsTree(){
        $all = collect([]);
        $parent = $this->parents;
        if($parent)
        {
            $all->push($parent);
            $all = $all->merge($parent->parentsTree());
        }
        return $all;
    }

    public function childs()
    {
        $all = collect([]);
        $childs = $this->children;
        if(!$childs->isEmpty())
        {
            foreach($childs as $children)
            {
                $all->push($children);
                $all = $all->merge($children->childs());
            }
        }
        return $all;
    }

    public function parentAndChildrenTree()
    {
        $childs = $this->childs();
        $parents = $this->parentsTree();
        $all = $parents->merge($childs);
        return $all;
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($canselation) {
            $canselation->translation()->delete();
        });


    }
}
