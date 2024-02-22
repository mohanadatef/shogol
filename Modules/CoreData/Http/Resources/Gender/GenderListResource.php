<?php

namespace Modules\CoreData\Http\Resources\Gender;
use Illuminate\Http\Resources\Json\JsonResource;

class GenderListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            ];
    }
}
