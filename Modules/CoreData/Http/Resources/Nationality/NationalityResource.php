<?php

namespace Modules\CoreData\Http\Resources\Nationality;

use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'order' => $this->order,
            'status' => $this->status,
            'code' => $this->code,
            'logo'=>  $this->logo ? getFile($this->logo->file??null,pathType()['ip'],getFileNameServer($this->logo)) : '',
        ];
    }
}
