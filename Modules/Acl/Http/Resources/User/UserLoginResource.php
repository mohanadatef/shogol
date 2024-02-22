<?php

namespace Modules\Acl\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\Role\RoleResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Category\CategoryListResource;
use Modules\CoreData\Http\Resources\Category\CategoryTaskResource;
use Modules\CoreData\Http\Resources\JobName\JobNameListResource;

class UserLoginResource extends JsonResource
{
    use validationRulesTrait;
    public function toArray($request)
    {
        $mobile=$this->mobile;
        if(languageLocale() == 'ar')
        {
            $mobile=$this->convertPersianAr($this->mobile);
        }
        return [
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->fullname ?? "",
            'email' => $this->email,
            'mobile' => $mobile,
            'role' => new RoleResource($this->role),
            'job_name_id' => new JobNameListResource($this->job_name),
            'token' => $this->token,
            'avatar' => getImag($this->avatar,'user',$this->id),
            'cover' => getImag($this->cover,'user',$this->id),
            'available' => $this->available,
            'category' => CategoryTaskResource::collection($this->category),
            'profile_validation'=> permissionGroup('user-profile-validation') ? 1 : ((getValueSetting('performers_profile_open') <= $this->complete_profile || getValueSetting('performers_profile_open') == 0) ? 1 : 0),
            'lat' => $this->lat,
            'lan' => $this->lan,
            'hidden_mobile' => $this->hidden_mobile,
            'email_verified_at' => $this->email_verified_at,
            ];
    }
}
