<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Media;
use Modules\Basic\Entities\Translation;

class Setting extends Model
{
    protected $fillable = [
        'key','value'
    ];
    protected $table = 'settings';
    public $timestamps = true;

    public $searchRelationShip  = [];

    public static $rules = [
        'logos' => 'image|mimes:jpg,jpeg,png,gif',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = ['key'=>'like'];
    public function translation()
    {
        return $this->morphMany(Translation::class, 'category');
    }
    public static function translationKey(){
        return ['home_section_1_title','home_section_1_description','home_section_2_title','home_section_2_description','home_section_3_title','home_section_4_title','home_section_5_title'];
    }
    public static function getValidationRules()
    {
        return self::$rules;
    }
    public function home_section_1_title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_1_title')
            ->where('language_id' ,languageId());
    }

    public function home_section_1_titleValue()
    {
        $home_section_1_titles=$this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_1_title')->get();
        return $home_section_1_titles->pluck('value','language.code')->toArray();
    }

    public function home_section_1_description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_1_description')
            ->where('language_id' ,languageId());
    }

    public function home_section_1_descriptionValue()
    {
        $home_section_1_descriptions=$this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_1_description')->get();
        return $home_section_1_descriptions->pluck('value','language.code')->toArray();
    }
    public function home_section_2_title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_2_title')
            ->where('language_id' ,languageId());
    }

    public function home_section_2_titleValue()
    {
        $home_section_2_titles=$this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_2_title')->get();
        return $home_section_2_titles->pluck('value','language.code')->toArray();
    }

    public function home_section_2_description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_2_description')
            ->where('language_id' ,languageId());
    }

    public function home_section_2_descriptionValue()
    {
        $home_section_2_descriptions=$this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_2_description')->get();
        return $home_section_2_descriptions->pluck('value','language.code')->toArray();
    }
    public function home_section_3_title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_3_title')
            ->where('language_id' ,languageId());
    }

    public function home_section_3_titleValue()
    {
        $home_section_3_titles=$this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_3_title')->get();
        return $home_section_3_titles->pluck('value','language.code')->toArray();
    }
    public function home_section_4_title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_4_title')
            ->where('language_id' ,languageId());
    }

    public function home_section_4_titleValue()
    {
        $home_section_4_titles=$this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_4_title')->get();
        return $home_section_4_titles->pluck('value','language.code')->toArray();
    }
    public function home_section_5_title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_5_title')
            ->where('language_id' ,languageId());
    }

    public function home_section_5_titleValue()
    {
        $home_section_5_titles=$this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_5_title')->get();
        return $home_section_5_titles->pluck('value','language.code')->toArray();
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'category');
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'category');
    }

    public function logo()
    {
        return $this->media()->whereType(mediaType()['lm']);
    }
    public function image()
    {
        return $this->media()->whereType(mediaType()['im']);
    }
    public function images()
    {
        return $this->medias()->whereType(mediaType()['im']);
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->media()->delete();
        });

    }
}
