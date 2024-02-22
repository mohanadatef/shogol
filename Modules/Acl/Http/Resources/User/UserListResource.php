<?php

namespace Modules\Acl\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\Role\RoleResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Category\CategoryListResource;
use Modules\CoreData\Http\Resources\Category\CategoryTaskResource;
use Modules\CoreData\Http\Resources\JobName\JobNameListResource;
use Modules\CoreData\Http\Resources\Nationality\NationalityListResource;

class UserListResource extends JsonResource
{
    use validationRulesTrait;
    public function toArray($request)
    {
        $rate=$this->rate ?? 0;
        $rate_count=$this->rate_count ?? 0;
        $complete_profile=$this->complete_profile ?? 0;
        if(languageLocale() == 'ar')
        {
            $rate=$this->convertPersianAr($this->rate);
            $rate_count=$this->convertPersianAr($this->rate_count);
            $complete_profile=$this->convertPersianAr($this->complete_profile);
        }
        return [
            'id' => $this->id,
            'fullname' => $this->fullname ?? "",
            'username' => $this->username ?? "",
            'job_name_id' => new JobNameListResource($this->job_name),
            'info' => $this->info,
            'avatar' => getImag($this->avatar,'user',$this->id),
            'nationality' => new NationalityListResource($this->nationality),
            'category' => CategoryTaskResource::collection($this->category),
            'available' => $this->available,
            'complete_profile'=>$complete_profile,
            'rate'=> ['rate'=>$rate??0,'count'=>$rate_count??0,'client_rate'=>$this->client_rate??0],
            'lat' => $this->lat,
            'lan' => $this->lan,
            'is_favourite' => $this->isFavourite,
            'hidden_mobile' => $this->hidden_mobile,
            'email_verified_at' => $this->email_verified_at,
        ];
    }
}
