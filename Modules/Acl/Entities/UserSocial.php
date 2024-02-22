<?php

namespace Modules\Acl\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CoreData\Entities\Social;

class UserSocial extends Model
{
    protected $fillable = [
        'user_id','social_id','value'
    ];
    protected $table = 'user_socials';
    public $timestamps = true;
    
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public $searchRelationShip  = [];
    public function social()
    {
        return $this->belongsTo(Social::Class);
    }
}
