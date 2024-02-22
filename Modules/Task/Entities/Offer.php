<?php

namespace Modules\Task\Entities;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Comment;
use Modules\CoreData\Entities\Currency;
use Modules\CoreData\Entities\Status;

class Offer extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'change', 'task_id', 'user_id', 'status_id', 'price', 'time', 'currency_id','description'
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    protected $appends = ['createdAtValue'];
    public $searchRelationShip  = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['task', 'user', 'status'];
    //TODO make currency required when make manual
    public static $rules = [
        'price' => 'required|numeric',
        'time' => 'required|numeric',
        'currency_id' => 'exists:currencies,id',
        'task_id' => 'required|exists:tasks,id',
        'description' => 'required|string|min:30|max:5000',
    ];

    public static function getValidationRules(): array
    {
        return self::$rules;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'category');
    }

    public function comment()
    {
        return $this->morphOne(Comment::class, 'category');
    }

    public function reject_comments()
    {
        return $this->comment()->where('type', commentType()['rac']);
    }

    public function cansel_comments()
    {
        return $this->comment()->where('type', commentType()['ac']);
    }

    /**
     * calculate time and date
     */
    public function getCreatedAtValueAttribute()
    {
        $now = Carbon::now();
        $created_at = $this->created_at;
        return $created_at->diffInHours($now) <= 23 ? ($created_at->diffInHours($now) == 0 ? $created_at->diffInMinutes($now) . " " . getCustomTranslation('Minute') : $created_at->diffInHours($now) . " " . getCustomTranslation('Hour')) : $created_at->diffInDays($now) . " " . getCustomTranslation('Day');
    }
}
