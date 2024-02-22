<?php

namespace Modules\Acl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeviceToken extends Model
{

    protected $fillable = ['device_token','user_id'];
    protected $table = 'device_tokens';


}
