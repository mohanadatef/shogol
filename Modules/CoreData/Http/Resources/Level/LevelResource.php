<?php

namespace Modules\CoreData\Http\Resources\Level;

use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'order' => $this->order,
            'level' => $this->level,
            'status' => $this->status,
        ];
    }
}
