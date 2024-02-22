<?php

namespace Modules\CoreData\Http\Resources\Area;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\City\CityResource;
use Modules\CoreData\Http\Resources\Country\CountryResource;
use Modules\CoreData\Http\Resources\State\StateResource;

class AreaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'order' => $this->order,
            'status' => $this->status,
            'country'=> new CountryResource($this->country),
            'city'=> new CityResource($this->city),
            'state'=> new StateResource($this->state)

        ];
    }
}
