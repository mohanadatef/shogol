<?php

namespace Modules\Acl\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\CoreData\Entities\Level;

class Skill extends Model
{
    protected $fillable = [
        'user_id', 'level_id', 'type', 'skill'
    ];
    protected $table = 'skills';
    public $timestamps = true;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [];
    public $searchRelationShip  = [];
    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::Class, 'level_id');
    }

    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
}
