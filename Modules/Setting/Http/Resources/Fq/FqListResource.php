<?php

namespace Modules\Setting\Http\Resources\Fq;
use Illuminate\Http\Resources\Json\JsonResource;

class FqListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'answer' => $this->answer->value ?? "",
            'question' => $this->question->value ?? "",
            ];
    }
}
