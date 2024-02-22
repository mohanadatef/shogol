<?php

namespace Modules\Task\Entities;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\Favourite;
use Modules\Basic\Entities\Comment;
use Modules\Basic\Entities\Media;
use Modules\CoreData\Entities\Category;
use Modules\CoreData\Entities\Currency;
use Modules\CoreData\Entities\Status;
use Modules\Setting\Entities\Report;

class Task extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'description', 'price', 'time', 'user_id', 'status_id', 'type_work', 'address','lan','lat','view',
        'freelancer_id', 'currency_id', 'type','offer_status'
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [
        'name'=>'like',
    ];
    public $searchRelationShip  = ['category'=>'task_category->category_id',
        'role'=>'user->role_id',];
    protected $appends = ['createdAtValue','isFavourite','offerCount'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['status', 'user', ];
    //TODO make currency required when make manual
    public static $rules = [
        'type_work' => 'string|in:',
        'name' => 'required|min:10|max:100|string',
        'description' => 'required|min:0|max:5000|string',
        'address' => 'min:2|max:150|string',
        'price' => 'numeric',
        'time' => 'numeric',
        'freelancer_id' => 'exists:users,id',
        'currency_id' => 'exists:currencies,id',
        'category' => 'required|array|exists:categories,id',
        'videos' => 'array',
        'videos.*.type' => 'in:mp4',
        'images' => 'array',
        'images.*.type' => 'in:jpg,jpeg,png,gif',
        'file' => 'array',
        'file.*.type' => 'in:pdf,word,zip,xlsx,docx',
        'file.*.file' => 'string',
        'images.*.file' => 'string',
        'videos.*.file' => 'string',
    ];

    public static function getValidationRules()
    {
        $rules = self::$rules;
        $rules['type_work'] .= workType()['on'] . ',' . workType()['of'];
        $rules['address'] .= '|required_if:type_work,' . workType()['of'];
        return $rules;
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'category');
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'category');
    }

    public function documents()
    {
        return $this->medias()->whereType(mediaType()['dm']);
    }

    public function doneFile()
    {
        return $this->medias()->whereType(mediaType()['dcm']);
    }

    public function category()
    {
        return $this->belongsToMany(Category::Class, 'task_categories');
    }

    public function task_category()
    {
        return $this->hasMany(TaskCategory::Class);
    }
    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::Class, 'freelancer_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::Class, 'currency_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::Class, 'status_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'category');
    }

    public function comment()
    {
        return $this->morphOne(Comment::class, 'category');
    }

    public function doneComment()
    {
        return $this->comment()->where('type', commentType()['dc']);
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
     * @return string
     * calculate time and date
     */
    public function getCreatedAtValueAttribute(): string
    {
        $now = Carbon::now();
        $created_at = $this->created_at;
        return $created_at->diffInHours($now) <= 23 ? ($created_at->diffInHours($now) == 0 ? $created_at->diffInMinutes($now) . " " . getCustomTranslation('Minute') : $created_at->diffInHours($now) . " " . getCustomTranslation('Hour')) : $created_at->diffInDays($now) . " " . getCustomTranslation('Day');
    }

    public function getIsFavouriteAttribute()
    {
        return user() ? $this->favourite()->where('user_id',user()->id)->count() : 0;
    }
    public function getOfferCountAttribute()
    {
        return  $this->offers()->count();
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function offer()
    {
        return $this->offers()->where('status_id',statusType()['is']);
    }

    public function offerActive()
    {
        return $this->offers()->whereIn('status_id',[statusType()['is'],statusType()['ns'],statusType()['es'],statusType()['us']]);
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class, 'category');
    }

    public function report()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($task) {
            $task->medias()->delete();
            $task->task_category()->delete();
        });

    }
}
