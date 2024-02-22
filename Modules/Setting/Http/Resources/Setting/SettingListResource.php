<?php

namespace Modules\Setting\Http\Resources\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingListResource extends JsonResource
{
    public function toArray($request)
    {
        $value = $this->value ?? "";
        if(str_contains($this->key,'logos')){
            $value = getLogoSetting();
        }elseif(str_contains($this->key, 'home') ){
            if(str_contains($this->key, 'title') || str_contains($this->key, 'description')){
                $value = $this->{$this->key}->value ?? "";
            }
        }else{
            $value = $this->value ?? "";
        }
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $value,
            ];
    }
}
