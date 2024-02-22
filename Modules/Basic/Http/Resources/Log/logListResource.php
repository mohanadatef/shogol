<?php

namespace Modules\Basic\Http\Resources\Log;

use Illuminate\Http\Resources\Json\JsonResource;

class logListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'value' => $this->comment,
        ];
    }
}
