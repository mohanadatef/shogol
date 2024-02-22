<?php

namespace Modules\Task\Http\Resources\Task;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Http\Resources\Category\CategoryTaskResource;

class TaskListResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     * @uses task
     * when get many
     */
    use validationRulesTrait;
    public function toArray($request)
    {
        $offerCount=$this->offerCount;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'offerStatus'=>$this->offer_status,
            'type_work'=>$this->type_work,
            'category' => CategoryTaskResource::collection($this->category),
            'offerCount'=>$offerCount,
            'is_favourite' => $this->isFavourite,
            'lat' => $this->lat,
            'lan' => $this->lan,
            'created_at_value' => $this->createdAtValue,
        ];
    }
}
