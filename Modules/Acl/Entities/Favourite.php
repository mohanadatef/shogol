<?php

namespace Modules\Acl\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Task\Entities\Ad;

class Favourite extends Model
{
    protected $fillable = [
        'user_id'
    ];
    protected $table = 'favourites';
    public $timestamps = true;


    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public $searchRelationShip  = [];

    public function favourite()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
