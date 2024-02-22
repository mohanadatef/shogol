<?php

namespace Modules\CoreData\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'parent_id'=>$this->parent_id,
            'order' => $this->order,
            'status' => $this->status,
            'type_work' => $this->type_work,
            'children' => CategoryListResource::collection($this->children),
        ];
    }
}
