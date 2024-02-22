<?php

namespace Modules\Acl\Http\Resources\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $this->display_name->value ?? "",
            'description' => $this->description->value ?? "",
        ];
    }
}
