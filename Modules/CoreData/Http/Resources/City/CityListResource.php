<?php

namespace Modules\CoreData\Http\Resources\City;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\Country\CountryListResource;

class CityListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'country'=> new CountryListResource($this->country)
        ];
    }
}
