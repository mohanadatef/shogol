<?php

namespace Modules\Basic\Entities;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Cancellation;

class Comment extends Model
{

    protected $fillable = [
        'comment', 'type','done_by','comment_id','cancellation_id'
    ];

    protected $table = 'comments';
    protected $appends = ['createdAtValue'];
    public $timestamps = true;
    public $searchRelationShip  = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['done_by_user'];

    public function comment()
    {
        return $this->morphTo();
    }

    public function done_by_user()
    {
        return $this->belongsTo(User::class, 'done_by');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function parents()
    {
        return $this->belongsTo(Comment::class, 'comment_id',  'id');
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

    public function getCreatedAtValueAttribute()
    {
        $now = Carbon::now();
        $created_at = $this->created_at;
        return $created_at->diffInHours($now) <= 23 ? ($created_at->diffInHours($now) == 0 ? $created_at->diffInMinutes($now) . " " . getCustomTranslation('Minute') : $created_at->diffInHours($now) . " " . getCustomTranslation('Hour')) : $created_at->diffInDays($now) . " " . getCustomTranslation('Day');
    }

    public function cancellation()
    {
        return $this->belongsTo(Cancellation::class, 'cancellation_id');
    }
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
}
