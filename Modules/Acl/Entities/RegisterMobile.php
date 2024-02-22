<?php

namespace Modules\Acl\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterMobile extends Model
{
    protected $fillable = [
        'mobile', 'code', 'status'
    ];
    protected $table = 'register_mobiles';
    public $timestamps = true;
    use SoftDeletes;

    public $searchRelationShip  = [];
    protected $dates = ['deleted_at'];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];

    public static $rules = [
        'mobile' => 'exists:register_mobiles,mobile',
        'code' => 'exists:register_mobiles,code'
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }
}
