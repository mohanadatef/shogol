<?php

namespace Modules\Basic\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\reviewProfileResource;

class reviewListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'rate' => $this->review,
            'created_at' => $this->createdAtValue,
            'done_by' => new  reviewProfileResource($this->done_by_user),
        ];
    }
}
