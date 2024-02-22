<?php

namespace Modules\Task\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Task\Entities\Ad;
use Modules\Task\Http\Requests\Ad\Api\CreateRequest;
use Modules\Task\Http\Requests\Ad\Api\rejectApproveRequest;
use Modules\Task\Http\Resources\Ad\AdResource;
use Modules\Task\Service\AdService;

class AdController extends BasicController
{
    private $service;

    public function __construct(AdService $Service)
    {
        $this->middleware('auth:api')->except(['list','show','searchTitle']);
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        $data = $this->service->list($request,$this->pagination(),$this->perPage());
        return $this->apiResponse($data, getCustomTranslation('Done'));
    }

    public function store(CreateRequest $request)
    {
        $data = $this->service->store($request);
        if (!is_string($data)) {
            return $this->createResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError($data);
    }

    public function update(CreateRequest $request,$id)
    {
        $data = $this->service->update($request,$id);
        if (!is_string($data)) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError($data);
    }

    public function myList(Request $request)
    {
        return $this->apiResponse($this->service->myList($request,$this->pagination(),$this->perPage()), getCustomTranslation('Done'));
    }

    public function cansel(rejectApproveRequest $request)
    {
        $data = $this->service->cansel($request);
        if (!is_string($data)) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError($data);
    }

    public function updateTime($id)
    {
        $data = $this->service->updateTime($id);
        if ($data) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function show($id)
    {
        $data = $this->service->show($id,true);
        if ($data) {
            return $this->apiResponse(new AdResource($data), getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function delete($id)
    {
        $data = $this->service->delete($id);
        if (!is_string($data)) {
            return $this->deleteResponse(getCustomTranslation('Done'));
        }
        return $this->unKnowError($data);
    }

    public function searchTitle(Request $request)
    {
        $ad=[];
        if(!empty($request->searchName) && strlen($request->searchName) > 2) {
            ActiveLog( null, actionType()['ssea'], $request->searchName,Ad::class,1);
            $data = $this->service->findBy(new Request(['name' => $request->searchName]), limit: 4);
            $ad = $data->pluck('name')->toArray();
            if (count($ad) < 4) {
                $data = $this->service->findBy(new Request(['description' => $request->searchName]), limit: 4 - count($ad));
                $ad = array_merge($ad, $data->pluck('name')->toArray());
            }
        }
        if (count($ad)) {
            return $this->apiResponse($ad,getCustomTranslation('Done'));
        }
        return $this->apiResponse([],getCustomTranslation('Done'));
    }
}
