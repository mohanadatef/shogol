<?php

namespace Modules\CoreData\Http\Resources\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'type_work' => $this->type_work,
            'children' => CategoryListResource::collection($this->children),
            'parent_id'=>$this->parent_id,
            ];
    }
}
