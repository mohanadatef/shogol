<?php

namespace Modules\Acl\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\Role\RoleResource;
use Modules\Acl\Http\Resources\Social\socialUserResource;
use Modules\Basic\Http\Resources\Comment\commentResource;
use Modules\Basic\Http\Resources\Comment\commentUserResource;
use Modules\Basic\Http\Resources\Media\mediaResource;
use Modules\Acl\Http\Resources\Skill\skillResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Category\CategoryListResource;
use Modules\CoreData\Http\Resources\City\CityListResource;
use Modules\CoreData\Http\Resources\Country\CountryListResource;
use Modules\CoreData\Http\Resources\Gender\GenderListResource;
use Modules\CoreData\Http\Resources\JobName\JobNameListResource;
use Modules\CoreData\Http\Resources\Nationality\NationalityListResource;
use Modules\CoreData\Http\Resources\Area\AreaListResource;
use Modules\CoreData\Http\Resources\State\StateListResource;

class reviewProfileResource extends JsonResource
{
    use validationRulesTrait;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->fullname ?? "",
            'email' => $this->email,
        ];
    }
}
