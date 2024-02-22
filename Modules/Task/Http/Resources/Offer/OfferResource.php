<?php

namespace Modules\Task\Http\Resources\Offer;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserProfileResource;
use Modules\Basic\Http\Resources\Comment\commentListResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Status\StatusListResource;

class OfferResource extends JsonResource
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
            'user'=> new UserProfileResource($this->user),
            'status'=> new StatusListResource($this->status),
            'comment'=> commentListResource::collection($this->comments),
            'description'=>$this->description
        ];
    }
}
