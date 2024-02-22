<?php

namespace Modules\Task\Http\Resources\Ad;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserProfileResource;
use Modules\Basic\Http\Resources\Media\mediaResource;
use Modules\Basic\Traits\validationRulesTrait;
//use Modules\CoreData\Http\Resources\Area\AreaListResource;
use Modules\CoreData\Http\Resources\Category\CategoryResource;
//use Modules\CoreData\Http\Resources\City\CityListResource;
//use Modules\CoreData\Http\Resources\Country\CountryListResource;
use Modules\CoreData\Http\Resources\Category\CategoryTaskResource;
use Modules\CoreData\Http\Resources\Currency\CurrencyListResource;
//use Modules\CoreData\Http\Resources\State\StateListResource;
use Modules\CoreData\Http\Resources\Status\StatusListResource;

class AdResource extends JsonResource
{
    use validationRulesTrait;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_favourite' => $this->isFavourite,
            'status' => new StatusListResource($this->status),
            'user'=> new UserProfileResource($this->user),
            'currency'=>new CurrencyListResource($this->currency),
            'document'=>mediaResource::collection($this->documents),
            'category' => CategoryTaskResource::collection($this->category),
            'created_at_value' => $this->createdAtValue,
            'lat' => $this->lat,
            'lan' => $this->lan,
            'view' => $this->view,
            'mobile' => $this->mobile,
            'hidden_mobile' => $this->hidden_mobile,
        ];
    }
}
