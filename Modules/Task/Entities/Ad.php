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

class Ad extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'description', 'price', 'user_id', 'status_id', 'currency_id', 'lan','lat','view','mobile','hidden_mobile'
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [
        'name'=>'like',
        ];
    protected $appends = ['createdAtValue','isFavourite'];
    public $searchRelationShip  = ['category'=> 'ad_category->category_id',
        'available'=>'user->available',
        'rate'=>'user->rate',
        'role'=>'user->role_id',
        'name_user'=>'user->fullname->like'];
    //TODO make currency required when make manual
    public static $rules = [
        'name' => 'required|min:10|max:45|string',
        'description' => 'required|min:0|max:5000|string',
        'price' => 'numeric',
        'mobile' => 'nullable|numeric',
        'currency_id' => 'exists:currencies,id',
        'category' => 'required|array|exists:categories,id',
        'file' => 'array',
        'file.*.type' => 'in:pdf,word,zip,xlsx,docx',
        'file.*.file' => 'string',
        'images' => 'array',
        'images.*.type' => 'in:jpg,jpeg,png,gif',
        'images.*.file' => 'string',
        'videos' => 'array',
        'videos.*.type' => 'in:mp4',
        'videos.*.file' => 'string',
    ];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['status', 'user'];

    public static function getValidationRules()
    {
        return self::$rules;
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

    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id');
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

    public function reject_comments()
    {
        return $this->comment()->where('type', commentType()['rac']);
    }

    public function cansel_comments()
    {
        return $this->comment()->where('type', commentType()['ac']);
    }

    public function category()
    {
        return $this->belongsToMany(Category::Class, 'ad_categories');
    }

    public function ad_category()
    {
        return $this->hasMany(AdCategory::Class);
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class, 'category');
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

    public function getIsFavouriteAttribute()
    {
        return user() ? $this->favourite()->where('user_id',user()->id)->count() : 0;
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->medias()->delete();
            $user->ad_category()->delete();
            $user->favourite()->delete();
        });

    }

    public function report()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
