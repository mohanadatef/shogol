<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\UserSocial;
use Modules\Basic\Entities\Media;
use Modules\Basic\Entities\Translation;

class Social extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'socials';
    public $timestamps = true;
    public $searchRelationShip = [];



    public static $rules = [
        'order' => 'required|numeric|unique:socials',
        'logo' => 'image|mimes:jpg,jpeg,png,gif',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
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
        return $this->belongsToMany(User::Class, 'user_socials');
    }

    public function user_social()
    {
        return $this->hasMany(UserSocial::Class);
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'category');
    }

    public function logo()
    {
        return $this->media()->whereType(mediaType()['lm']);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($social) {
            $social->translation()->delete();
            $social->user_social()->delete();
            $social->media()->delete();

        });

    }
}
