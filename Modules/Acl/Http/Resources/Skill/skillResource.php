<?php

namespace Modules\Acl\Http\Resources\Skill;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\Level\LevelListResource;

class skillResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'level' => new LevelListResource($this->level),
            'level_id' => $this->level->level,
            'type' => $this->type,
            'skill' => $this->skill,
        ];
    }
}
