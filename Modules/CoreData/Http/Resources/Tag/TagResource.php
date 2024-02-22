<?php

namespace Modules\CoreData\Http\Resources\Tag;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\Category\CategoryResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'order' => $this->order,
            'status' => $this->status,
            'category'=> new CategoryResource($this->category)
        ];
    }
}
