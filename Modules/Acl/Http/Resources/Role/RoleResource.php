<?php

namespace Modules\Acl\Http\Resources\Role;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\Permission\PermissionListResource;

class RoleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
           // 'permission'=>PermissionListResource::collection($this->permission),
        ];
    }
}
