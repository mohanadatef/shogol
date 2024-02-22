<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\UserCategory;
use Modules\Task\Entities\AdCategory;
use Modules\Basic\Entities\Translation;
use Modules\Task\Entities\Ad;
use Modules\Task\Entities\Task;
use Modules\Task\Entities\TaskCategory;

class Category extends Model
{
    protected $fillable = [
        'status', 'order', 'parent_id', 'type_work'
    ];
    protected $table = 'categories';
    public $timestamps = true;
    public static $rules = [
        'order' => 'nullable|numeric',
        'type_work' => 'required',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = ['name' => 'like'];
    public $searchRelationShip = [];
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

    public function nameValue()
    {
        $names = $this->morphone(Translation::class, 'category')
            ->where('key', 'name')->get();
        return $names->pluck('value', 'language.code')->toArray();
    }

    public function user()
    {
        return $this->belongsToMany(User::Class, 'user_categories');
    }

    public function user_category()
    {
        return $this->hasMany(UserCategory::Class);
    }

    public function task()
    {
        return $this->belongsToMany(Task::Class, 'task_categories');
    }

    public function task_category()
    {
        return $this->hasMany(TaskCategory::Class);
    }

    public function ad()
    {
        return $this->belongsToMany(Ad::Class, 'ad_categories');
    }

    public function tags()
    {
        return $this->hasMany(Tag::Class);
    }

    public function tag()
    {
        return $this->hasOne(Tag::Class);
    }

    public function ad_category()
    {
        return $this->hasMany(AdCategory::Class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parents()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function parentsTree()
    {
        $all = collect([]);
        $parent = $this->parents;
        if ($parent) {
            $all->push($parent);
            $all = $all->merge($parent->parentsTree());
        }
        return $all;
    }

    public function childs()
    {
        $all = collect([]);
        $childs = $this->children;
        if (!$childs->isEmpty()) {
            foreach ($childs as $children) {
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

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($category) {
            $category->translation()->delete();
        });


    }
}
