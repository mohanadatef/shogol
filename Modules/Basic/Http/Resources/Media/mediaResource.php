<?php

namespace Modules\Basic\Http\Resources\Media;

use Illuminate\Http\Resources\Json\JsonResource;

class mediaResource extends JsonResource
{
    public function toArray($request)
    {
        if(in_array($this->type,[mediaType()['dm'],mediaType()['dcm']]))
        {
            $path= pathType()['up'];
        }elseif(in_array($this->type,[mediaType()['am']]))
        {
            $path= pathType()['ip'];
        }else{
            $path=pathType()['ip'];
        }
        return [
            'id' => $this->id,
            'file' => getFile($this->file,$path,getFileNameServer($this)),
        ];
    }
}
