<?php

namespace Modules\CoreData\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
        ];
    }
}
