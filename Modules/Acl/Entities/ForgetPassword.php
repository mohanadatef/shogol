<?php

namespace Modules\Acl\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForgetPassword extends Model
{
    protected $fillable = [
        'user_id', 'code', 'status'
    ];
    protected $table = 'forget_passwords';
    public $timestamps = true;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id')->withTrashed();
    }
    public $searchRelationShip  = [];
    protected $dates = ['deleted_at'];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];

    public static $rules = [
        'password' => 'required|confirmed|min:8',
        'user_id' => 'exists:users,id'
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }

    public static function getValidationRulesAdmin()
    {
        return [
            'password' => 'required|confirmed|min:8',
            'email' => 'exists:users,email',
            'code' => 'exists:forget_passwords,code'
        ];
    }
}
