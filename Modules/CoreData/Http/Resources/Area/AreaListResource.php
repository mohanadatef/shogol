<?php

namespace Modules\CoreData\Http\Resources\Area;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\City\CityListResource;
use Modules\CoreData\Http\Resources\Country\CountryListResource;
use Modules\CoreData\Http\Resources\State\StateListResource;

class AreaListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'country'=> new CountryListResource($this->country),
            'city'=> new CityListResource($this->city),
            'state'=> new StateListResource($this->state)
        ];
    }
}
