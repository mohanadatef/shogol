<?php

namespace Modules\Task\Http\Resources\Ad;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserAdProfileResource;
use Modules\Basic\Http\Resources\Media\mediaResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Category\CategoryTaskResource;
use Modules\CoreData\Http\Resources\Currency\CurrencyListResource;

class AdListResource extends JsonResource
{
    use validationRulesTrait;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'created_at_value' => $this->createdAtValue,
            'user'=> new UserAdProfileResource($this->user),
            'currency'=>new CurrencyListResource($this->currency),
            'category' => CategoryTaskResource::collection($this->category),
            'document'=>mediaResource::collection($this->documents),
            'lat' => $this->lat,
            'lan' => $this->lan,
            'is_favourite' => $this->isFavourite,
        ];
    }
}
