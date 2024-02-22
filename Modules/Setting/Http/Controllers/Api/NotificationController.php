<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Resources\notification\NotificationResource;
use Modules\Setting\Service\NotificationService;

class NotificationController extends BasicController
{
    private $service;

    public function __construct(NotificationService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        if(user())
        {
            $request->merge(['receiver_id' => user()->id]);
            return $this->apiResponse($this->service->list($request, $this->pagination(), $this->perPage()),
                getCustomTranslation('Done'));
        }
        return $this->apiResponse([], getCustomTranslation('Done'));
    }

    public function read($id)
    {
        $data = $this->service->readNotification($id);
        if($data)
        {
            return $this->apiResponse(new NotificationResource($data), getCustomTranslation('Done'));
        }
        return $this->unKnowError('problem id');
    }
}
