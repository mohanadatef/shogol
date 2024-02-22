<?php

namespace Modules\Task\Entities;

use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    protected $fillable = [
        'task_id','category_id'
    ];
    protected $table = 'task_categories';
    public $timestamps = true;
    public $searchRelationShip  = [];
    

    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
}
