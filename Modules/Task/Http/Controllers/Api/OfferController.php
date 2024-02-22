<?php

namespace Modules\Task\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Task\Http\Requests\Offer\Api\CreateRequest;
use Modules\Task\Http\Requests\Offer\Api\rejectApproveRequest;
use Modules\Task\Service\OfferService;

/**
 * @extends BasicController
 * controller offer about api function
 */
class OfferController extends BasicController
{
    private $service;

    /**
     * @param OfferService $Service
     * @required login for all function @except list
     */
    public function __construct(OfferService $Service)
    {
        $this->middleware('auth:api');
        $this->service = $Service;
    }

    /**
     * @param Request $request
     * @result all offer can @see in the task
     */
    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()), getCustomTranslation('Done'));
    }

    /**
     * @param CreateRequest $request
     * @result new offer
     */
    public function store(CreateRequest $request)
    {
        $data = $this->service->store($request);
        if ($data['result']) {
            return $this->createResponse($data['data'], getCustomTranslation('Done'));
        }
        return $this->unKnowError($data['message'] ?? null);
    }

    /**
     * @param CreateRequest $request
     * @param $id => offer need to update it
     * @result update row in database
     */
    public function update(Request $request, $id)
    {
        $data = $this->service->update($request, $id);
        if (!is_string($data)) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError($data);
    }

    /**
     * @param rejectApproveRequest $request
     * @result hidden this offer for task by user
     */
    public function cansel(rejectApproveRequest $request)
    {
        $data = $this->service->cansel($request);
        if (!is_string($data)) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError($data);
    }

    /**
     * @param $id => offer need to update it
     * @result updated offer for show it in task again
     */
    public function updateTime($id)
    {
        $data = $this->service->updateTime($id);
        if ($data) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param $id => offer client accept it
     * approve offer for task
     */
    public function acceptApprove($id)
    {
        $data = $this->service->approve($id);
        if ($data) {
            return $this->updateResponse([], getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param Request $request
     * un approve offer for task
     */
    public function unApproved(Request $request)
    {
        $data = $this->service->unApprove($request);
        if ($data) {
            return $this->updateResponse([], getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param Request $request
     * comment in offer between client and user owner offer
     */
    public function comment(Request $request)
    {
        $data = $this->service->comment($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param Request $request
     * @result all offer user @create it
     */
    public function myList(Request $request)
    {
        return $this->apiResponse($this->service->myList($request,$this->pagination(),$this->perPage()), getCustomTranslation('Done'));
    }

    /**
     * @param $id
     * client order to edit offer
     */
    public function edit($id)
    {
        $data = $this->service->edit($id);
        if ($data) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }
}
