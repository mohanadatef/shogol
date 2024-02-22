<?php

namespace Modules\Task\Http\Resources\Offer;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserProfileResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Status\StatusListResource;
use Modules\Task\Http\Resources\Task\TaskResource;

class OfferListResource extends JsonResource
{
    use validationRulesTrait;
    public function toArray($request)
    {
        $price=$this->price;
        if(languageLocale() == 'ar')
        {
            $price=$this->convertPersianAr($this->price);
        }
        return [
            'id' => $this->id,
            'change' => $this->change,
            'price' => $price,
            'time' => $this->time,
            'created_at_value' => $this->createdAtValue,
            'description'=>$this->description,
            'user'=> new UserProfileResource($this->user),
            'task'=> new TaskResource($this->task),
            'status'=> new StatusListResource($this->status),
        ];
    }
}
