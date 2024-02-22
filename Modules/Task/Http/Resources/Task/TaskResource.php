<?php

namespace Modules\Task\Http\Resources\Task;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserProfileResource;
use Modules\Basic\Http\Resources\Media\mediaResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Category\CategoryResource;
use Modules\CoreData\Http\Resources\Category\CategoryTaskResource;
use Modules\CoreData\Http\Resources\Currency\CurrencyListResource;
use Modules\CoreData\Http\Resources\Status\StatusListResource;
use Modules\Task\Http\Resources\Offer\OfferResource;

class TaskResource extends JsonResource
{
    /**
     * @param $request
     * @uses task
     * when get one
     */
    use validationRulesTrait;
    public function toArray($request)
    {
        $price=$this->price;
        $offerCount=$this->offerCount;
        $time=$this->time;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $price,
            'time' => $time,
            'is_favourite' => $this->isFavourite,
            'status' => new StatusListResource($this->status),
            'type_work'=>$this->type_work,
            'user'=> new UserProfileResource($this->user),
            'freelancer'=> new UserProfileResource($this->freelancer),
            'address'=>$this->address,
            'currency'=>new CurrencyListResource($this->currency),
            'document'=>mediaResource::collection($this->documents),
            'created_at_value' => $this->createdAtValue,
            'category' => CategoryTaskResource::collection($this->category),
            'offer'=> OfferResource::collection($this->offerActive),
            'offerCount'=>$offerCount,
            'offerStatus'=>$this->offer_status,
            'userStatusTask'=> user() && user()->id == $this->user_id ? $this->status->task_owner->value ?? "" : $this->status->offer_owner->value ?? "",
            'userStatusTaskDescription'=> user() && user()->id == $this->user_id ? $this->status->task_owner_description->value ?? "" : $this->status->offer_owner_description->value ?? "",
            'userStatusColor'=>user() && user()->id == $this->user_id ? $this->status->task_owner_color : $this->status->offer_owner_color,
            'done_file'=> ['comment'=>$this->doneComment->comment ?? "",'file'=>mediaResource::collection($this->doneFile)],
            'lat' => $this->lat,
            'lan' => $this->lan,
            'view' => $this->view,
        ];
    }
}
