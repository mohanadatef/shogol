<?php

namespace Modules\Setting\Http\Resources\notification;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserProfileResource;

class NotificationListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'read' => $this->readAtValue,
            'created_at' => $this->createdAtValue,
            'title' => $this->title->value ?? "",
            'description' => $this->description->value ?? "",
            'notifiable_type' => $this->notifiable_type,
            'notifiable_id' => $this->notifiable_id,
            'pusher' => new UserProfileResource($this->pusher),
            'receiver' => new UserProfileResource($this->receiver),
        ];
    }
}
