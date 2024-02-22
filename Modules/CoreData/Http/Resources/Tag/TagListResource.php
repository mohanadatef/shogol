<?php

namespace Modules\CoreData\Http\Resources\Tag;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\Category\CategoryListResource;

class TagListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name->value ?? "",
        ];
    }
}
