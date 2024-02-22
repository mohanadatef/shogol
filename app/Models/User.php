<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Acl\Entities\Favourite;
use Modules\Acl\Entities\Role;
use Modules\Acl\Entities\Skill;
use Modules\Acl\Entities\UserCategory;
use Modules\Acl\Entities\UserSocial;
use Modules\Basic\Entities\Comment;
use Modules\Basic\Entities\Log;
use Modules\Basic\Entities\Media;
use Modules\CoreData\Entities\Category;
use Modules\CoreData\Entities\Gender;
use Modules\CoreData\Entities\Nationality;
use Modules\CoreData\Entities\Social;
use Modules\CoreData\Entities\JobName;
use Modules\Setting\Entities\Report;
use Modules\Setting\Entities\Review;
use Modules\Task\Entities\Ad;
use Modules\Task\Entities\Offer;
use Modules\Task\Entities\Task;
use Modules\Acl\Entities\DeviceToken;
use Modules\CoreData\Entities\Language;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', 'fullname', 'email', 'password', 'mobile', 'status', 'approve', 'gender_id',  'nationality_id', 'nationality_number',
        'token', 'job_name_id', 'email_verified_at', 'approved_at', 'description', 'tax_number', 'available', 'commercial_number',
        'complete_profile', 'info', 'role_id', 'lang', 'rate', 'rate_count','lat','lan','country_code','hidden_mobile','client_rate',
        'rate_provided','rate_quality','rate_client_count'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['role'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'approved_at' => 'datetime',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */

    public $searchConfig = [
        'fullname'=>'like',
        'mobile'=>'like',
    ];
    public $searchRelationShip = [
        'category' => 'user_category->category_id',
    ];
    protected $dates = [];
    public static $rules = [
        'username' => 'min:3|max:30|string|unique:users',
        'fullname' => 'min:8|max:20|string',
        'job_name' => 'nullable|min:8|max:50|string',
        'role_id' => 'in:2,3,4|exists:roles,id',
        'email' => 'regex:/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]/|min:2|max:50|email|unique:users',
        'mobile' => 'numeric|digits_between:8,17|unique:users',
        'nationality_number' => 'nullable|regex:/^[-0-9a-zA-Z.+_]+$/u|digits_between:4,30|unique:users',
        'tax_number' => 'nullable|regex:/^[-0-9a-zA-Z.+_]+$/u|digits_between:4,30|unique:users',
        'commercial_number' => 'nullable|regex:/^[-0-9a-zA-Z.+_]+$/u|digits_between:4,30|unique:users',
        'category' => 'array|min:1|exists:categories,id',
        'info' => 'string|min:30|max:5000',
        'job_name_id' => 'exists:job_names,id',
        'avatar' => 'array',
    ];

    public static $rulesUpdate = [
        'skill' => 'array',
        'skill.*.level_id' => 'exists:levels,id',
        'skill.*.skill' => 'string',
        'skill.*.type' => 'string|in:',
        'document' => 'array',
        'document.type' => 'mimes:jpg,jpeg,png,gif,xlsx,csv,xlx,pdf,word,mp4,webm',
        'avatar.type' => 'mimes:jpg,jpeg,png,gif',
        'social' => 'array',
        'social.*.value' => 'string',
        'social.*.social_id' => 'exists:socials,id',
        'description' => 'string|min:3|max:1500',
    ];

    protected static $PasswordRules = ['password' => 'required|min:8|max:25'];

    public static function getValidationRules()
    {
        $rules = self::$rules;
        $rules['category'] .= '|required_if:role_id,3,4';
        $rules['info'] .= '|required_if:role_id,3,4';
        $rules['job_name_id'] .= '|required_if:role_id,3,4';
        $rules['avatar'] .= '|required_if:role_id,3,4';
        $rules = array_merge($rules, self::$PasswordRules);
        return $rules;
    }

    public static function getValidationRulesLogin()
    {
        return self::$PasswordRules;
    }

    public static function getValidationRulesUpdate()
    {
        $rulesCreate = self::$rules;
        $rulesUpdate = array_merge($rulesCreate, self::$rulesUpdate);
        $rulesUpdate['skill.*.type'] .= implode(",", Array_values(skillType()));
        return $rulesUpdate;
    }

    public static function getValidationRulesPassword()
    {
        return self::$PasswordRules;
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'category');
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'category');
    }

    public function avatar()
    {
        return $this->media()->whereType(mediaType()['am']);
    }

    public function cover()
    {
        return $this->media()->whereType(mediaType()['cm']);
    }
    public function documents()
    {
        return $this->medias()->whereType(mediaType()['dm']);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function job_name()
    {
        return $this->belongsTo(JobName::class, 'job_name_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'user_categories');
    }

    public function user_category()
    {
        return $this->hasMany(UserCategory::class);
    }

    public function social()
    {
        return $this->belongsToMany(Social::class, 'user_socials');
    }

    public function user_social()
    {
        return $this->hasMany(UserSocial::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function language()
    {
        return $this->skills()->where('type', skillType()['ls']);
    }

    public function skill()
    {
        return $this->skills()->where('type', skillType()['ss']);
    }

    public function certificate()
    {
        return $this->skills()->where('type', skillType()['cs']);
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

    public function reject_comments_by()
    {
        return $this->hasMany(Comment::class)->where('type', commentType()['rac']);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function freelancer()
    {
        return $this->hasMany(Task::class,'freelancer_id');
    }

    public function ad()
    {
        return $this->hasMany(Ad::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

    public function myFavourite()
    {
        return $this->hasMany(Favourite::class);
    }

    public function myFavouriteAd()
    {
        return $this->hasMany(Favourite::class)->where('category_type', '=', 'ad');
    }

    public function myFavouriteTask()
    {
        return $this->hasMany(Favourite::class)->where('category_type', '=', 'task');
    }

    public function myFavouriteUser()
    {
        return $this->hasMany(Favourite::class)->where('category_type', '=', 'user');
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class, 'category');
    }

    public function report()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function lang()
    {
        return $this->belongsTo(Language::class,'lang');
    }

    public function taskComment()
    {
        return Comment::where('category_type','task')->whereIn('category_id',$this->task->pluck('id')->toArray())->where('type',commentType()['dc'])->get();
    }

    public function taskReview()
    {
        return $this->hasMany(Review::class);
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
            $user->skills()->delete();
            $user->user_category()->delete();
            $user->user_social()->delete();
            $user->favourite()->delete();
            $user->myFavourite()->delete();
        });
    }
}
