<?php

namespace Modules\CoreData\Http\Resources\Language;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            ];
    }
}
