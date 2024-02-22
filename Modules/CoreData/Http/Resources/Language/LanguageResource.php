<?php

namespace Modules\CoreData\Http\Resources\Language;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'order' => $this->order,
            'status' => $this->status,
        ];
    }
}
