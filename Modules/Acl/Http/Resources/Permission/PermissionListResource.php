<?php

namespace Modules\Acl\Http\Resources\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
