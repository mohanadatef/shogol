<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = [
        'status','subject','name','email','mobile','description'
    ];
    protected $table = 'contactus';
    public $timestamps = true;

    

    public $searchRelationShip  = [];
    public static $rules = [
        'name' => 'required|string|min:2|max:50',
        'email' => 'required|email|min:2|max:50',
        'description' => 'required|string|min:2|max:150',
        'mobile' => 'required|numeric|digits_between:8,17',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [
        'subject'=>'like',
        'name'=>'like',
        'email'=>'like',
        'mobile'=>'like'
    ];
    public static function getValidationRules()
    {
        return self::$rules;
    }
}
