<?php

namespace Modules\CoreData\Http\Resources\City;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\Country\CountryResource;

class CityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'order' => $this->order,
            'status' => $this->status,
            'country'=> new CountryResource($this->country)
        ];
    }
}
