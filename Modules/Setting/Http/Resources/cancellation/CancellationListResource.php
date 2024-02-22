<?php

namespace Modules\Setting\Http\Resources\cancellation;
use Illuminate\Http\Resources\Json\JsonResource;

class CancellationListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            ];
    }
}
