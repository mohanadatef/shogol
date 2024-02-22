<?php

namespace Modules\CoreData\Http\Resources\JobName;

use Illuminate\Http\Resources\Json\JsonResource;

class JobNameResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'order' => $this->order,
            'status' => $this->status,
        ];
    }
}
