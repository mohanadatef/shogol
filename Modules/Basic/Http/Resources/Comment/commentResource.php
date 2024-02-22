<?php

namespace Modules\Basic\Http\Resources\Comment;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserProfileResource;

class commentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'done_by' => new  UserProfileResource($this->done_by_user),
            'comment_parent' => new commentResource($this->parents),
        ];
    }
}
