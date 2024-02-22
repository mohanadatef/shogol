<?php

namespace Modules\Task\Entities;

use Illuminate\Database\Eloquent\Model;

class AdCategory extends Model
{
    protected $fillable = [
        'ad_id','category_id'
    ];
    protected $table = 'ad_categories';
    public $timestamps = true;
    

    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public $searchRelationShip  = [];
}
