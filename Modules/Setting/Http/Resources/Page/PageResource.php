<?php

namespace Modules\Setting\Http\Resources\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'description' => $this->description->value ?? "",
            'order' => $this->order,
            'status' => $this->status,
        ];
    }
}
