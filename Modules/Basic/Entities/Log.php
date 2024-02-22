<?php

namespace Modules\Basic\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{


    protected $fillable = ['comment', 'action', 'done_by', 'url','affected_id','affected_type','ip','search'];

    protected $table = 'logs';

    public $timestamps = true;
    public $searchRelationShip  = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['done_by_user'];
    public function affected()
    {
        return $this->morphTo();
    }

    public function done_by_user()
    {
        return $this->belongsTo(User::class, 'done_by');
    }

    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];

}
