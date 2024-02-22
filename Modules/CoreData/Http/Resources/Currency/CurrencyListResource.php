<?php

namespace Modules\CoreData\Http\Resources\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            ];
    }
}
