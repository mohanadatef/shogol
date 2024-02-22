<?php

namespace Modules\Acl\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\Role\RoleResource;
use Modules\Acl\Http\Resources\Social\socialUserResource;
use Modules\Basic\Http\Resources\Media\mediaResource;
use Modules\Acl\Http\Resources\Skill\skillResource;
use Modules\Basic\Http\Resources\Review\reviewListResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Category\CategoryTaskResource;
use Modules\CoreData\Http\Resources\Gender\GenderListResource;
use Modules\CoreData\Http\Resources\JobName\JobNameListResource;
use Modules\CoreData\Http\Resources\Nationality\NationalityListResource;

class UserProfileResource extends JsonResource
{
    use validationRulesTrait;
    public function toArray($request)
    {
        $rate=$this->rate ?? 0;
        $mobile=$this->mobile;
        $country_code=$this->country_code;
        $complete_profile=$this->complete_profile;
        $nationality_number=$this->nationality_number??0;
        $tax_number=$this->tax_number??0;
        $commercial_number=$this->commercial_number??0;
        $rate_count=$this->rate_count ?? 0;
        $rate_client_count=$this->rate_client_count ?? 0;
        return [
            'id' => $this->id,
            'username' => $this->username,
            'country_code' => $country_code,
            'fullname' => $this->fullname ?? "",
            'email' => $this->email,
            'mobile' => $mobile,
            'token' => $this->token,
            'role' => new RoleResource($this->role),
            'available' => $this->available,
            'nationality_number' => $nationality_number,
            'tax_number' => $tax_number,
            'commercial_number' => $commercial_number,
            'job_name' => new JobNameListResource($this->job_name),
            'description' => $this->description,
            'info' => $this->info,
            'avatar' => getImag($this->avatar,'user',$this->id),
            'cover' => getImag($this->cover,'user',$this->id),
            'gender' => new GenderListResource($this->gender),
            'nationality' => new NationalityListResource($this->nationality),
            'category' => CategoryTaskResource::collection($this->category),
            'language' =>  skillResource::collection($this->language),
            'skill' =>  skillResource::collection($this->skill),
            'skill_language' =>  skillResource::collection($this->skills),
            'certificate' =>  skillResource::collection($this->certificate),
            'document' =>  mediaResource::collection($this->documents),
            'social'=> socialUserResource::collection($this->user_social),
            'complete_profile'=>$complete_profile,
            'profile_validation'=> permissionShow('user-profile-validation') ? 1 : ((getValueSetting('performers_profile_open') <= $this->complete_profile || getValueSetting('performers_profile_open') == 0) ? 1 : 0),
            'reverse'=>[
                ['title'=>getCustomTranslation('email_approve'),'status'=>$this->email_verified_at != null ?1:0],
                ['title'=>getCustomTranslation('mobile_approve'),'status'=>1]
            ],
            'rate'=> ['rate'=>(float)$rate,'count'=>$rate_count,'rate_client_count'=>$rate_client_count,'rate_quality'=>(float)$this->rate_quality,'rate_provided'=>(float)$this->rate_provided,'client_rate'=>(float)$this->client_rate],
            'offer_count'=>$this->offers()->count(),
            'task_count'=>$this->freelancer()->count(),
            'client_count'=>$this->freelancer()->count(),
            'comment'=>reviewListResource::collection($this->taskReview),
            'lat' => $this->lat,
            'lan' => $this->lan,
            'hidden_mobile' => $this->hidden_mobile,
            'email_verified_at' => $this->email_verified_at,
        ];
    }
}
