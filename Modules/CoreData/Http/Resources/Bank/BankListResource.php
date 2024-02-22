<?php

namespace Modules\CoreData\Http\Resources\Bank;
use Illuminate\Http\Resources\Json\JsonResource;

class BankListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            ];
    }
}
