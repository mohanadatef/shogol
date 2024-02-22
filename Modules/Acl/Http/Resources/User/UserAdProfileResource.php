<?php

namespace Modules\Acl\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\JobName\JobNameListResource;
use Modules\CoreData\Http\Resources\Nationality\NationalityListResource;

class UserAdProfileResource extends JsonResource
{
    use validationRulesTrait;
    public function toArray($request)
    {
        $rate=$this->rate ?? 0;
        $rate_count=$this->rate_count ?? 0;
        return [
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->fullname ?? "",
            'hidden_mobile' => $this->hidden_mobile,
            'job_name' => new JobNameListResource($this->job_name),
            'avatar' => getImag($this->avatar,'user',$this->id),
            'nationality' => new NationalityListResource($this->nationality),
            'rate'=> ['rate'=>$rate,'count'=>$rate_count,'rate_quality'=>$this->rate_quality,'rate_provided'=>$this->rate_provided,'client_rate'=>$this->client_rate],
        ];
    }
}
