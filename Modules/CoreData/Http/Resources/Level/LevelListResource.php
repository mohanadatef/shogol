<?php

namespace Modules\CoreData\Http\Resources\Level;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'level' => $this->level,
            ];
    }
}
