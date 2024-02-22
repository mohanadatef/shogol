<?php

namespace Modules\CoreData\Http\Resources\State;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\City\CityResource;
use Modules\CoreData\Http\Resources\Country\CountryResource;

class StateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'order' => $this->order,
            'status' => $this->status,
            'country'=> new CountryResource($this->country),
            'city'=> new CityResource($this->city)
        ];
    }
}
