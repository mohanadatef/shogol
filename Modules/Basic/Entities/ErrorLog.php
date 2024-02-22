<?php

namespace Modules\Basic\Entities;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    

    protected $fillable = ['error','type','error_with'];
    public $searchRelationShip  = [];
}
