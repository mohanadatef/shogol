<?php

namespace Modules\Setting\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Task\Entities\Task;
use App\Models\User;

class Review extends Model
{

    protected $fillable = ['user_id','review_by','review','comment','task_id','provided','quality','client_rate'];

    public $searchConfig = [];
    public $searchRelationShip  = [];
    protected $appends = ['createdAtValue'];
    protected $with = ['user','reviewBy','task'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function done_by_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reviewBy()
    {
        return $this->belongsTo(User::class,'review_by');
    }

    public function getCreatedAtValueAttribute()
    {
        $now = Carbon::now();
        $created_at = $this->created_at;
        return $created_at->diffInHours($now) <= 23 ? ($created_at->diffInHours($now) == 0 ? $created_at->diffInMinutes($now) . " " . getCustomTranslation('Minute') : $created_at->diffInHours($now) . " " . getCustomTranslation('Hour')) : $created_at->diffInDays($now) . " " . getCustomTranslation('Day');
    }

    public function task()
    {
        return $this->belongsTo(Task::Class, 'task_id');
    }
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'task_id' => 'required|exists:tasks,id',
        'review' => 'min:1|max:5',
        'quality' => 'min:1|max:5',
        'provided' => 'min:1|max:5',
        'client_rate' => 'min:1|max:5',
    ];
    public static function getValidationRules()
    {
        return self::$rules;
    }

}
