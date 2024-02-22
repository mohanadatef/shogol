<?php

namespace Modules\CoreData\Http\Resources\State;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\City\CityListResource;
use Modules\CoreData\Http\Resources\Country\CountryListResource;

class StateListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'country'=> new CountryListResource($this->country),
            'city'=> new CityListResource($this->city)
        ];
    }
}
