<?php

namespace Modules\Basic\Http\Resources\CustomTranslation;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomTranslationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value->value ?? "",
            'status' => $this->status,
        ];
    }
}
