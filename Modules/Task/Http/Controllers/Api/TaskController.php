<?php

namespace Modules\Task\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Task\Entities\Task;
use Modules\Task\Http\Requests\Task\Api\CreateRequest;
use Modules\Task\Http\Requests\Task\Api\rejectApproveRequest;
use Modules\Task\Http\Resources\Task\TaskResource;
use Modules\Task\Service\TaskService;

/**
 * @extends BasicController
 * controller task about api function
 */
class TaskController extends BasicController
{
    private $service;

    /**
     * @param TaskService $Service
     * @required login for all function @except list
     */
    public function __construct(TaskService $Service)
    {
        $this->middleware('auth:api')->except(['list','show','searchTitle']);
        $this->service = $Service;
    }

    /**
     * @param Request $request
     * @result all task can @see in system
     * @note task must general @and status active 2
     */
    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage(),['where'=>['type'=>taskType()['gt']]]), getCustomTranslation('Done'));
    }

    /**
     * @param CreateRequest $request
     * @result new task
     */
    public function store(CreateRequest $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('description_new_Task'));
        }
        return $this->unKnowError();
    }

    /**
     * @param CreateRequest $request
     * @param $id => task need to update it
     * @result update row in database
     */
    public function update(CreateRequest $request, $id)
    {
        $data = $this->service->update($request, $id);
        if (!is_string($data)) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError($data);
    }

    /**
     * @param Request $request
     * @result get all task general user create it
     */
    public function myList(Request $request)
    {
        return $this->apiResponse($this->service->myList($request,$this->pagination(),$this->perPage()), getCustomTranslation('Done'));
    }

    /**
     * @param Request $request
     * @result get all task special for user
     */
    public function myListSpecial(Request $request)
    {
        return $this->apiResponse($this->service->myListSpecial($request,$this->pagination(),$this->perPage()), getCustomTranslation('Done'));
    }
    public function ListSpecial(Request $request)
    {
        return $this->apiResponse($this->service->ListSpecial($request,$this->pagination(),$this->perPage()), getCustomTranslation('Done'));
    }

    public function myListOffer(Request $request)
    {
        return $this->apiResponse($this->service->myListOffer($request,$this->pagination(),$this->perPage()), getCustomTranslation('Done'));
    }

    public function listCopy(Request $request)
    {
        return $this->apiResponse($this->service->listCopy($request,$this->pagination(),$this->perPage()), getCustomTranslation('Done'));
    }

    /**
     * @param rejectApproveRequest $request
     * @result hidden this task for system by user
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
     * @param $id => task need to update it
     * @result updated task for request to admin to show it in system again
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
     * @param $id
     * freelancer say he is done
     */
    public function doneFreelancer($id,Request $request)
    {
        $data = $this->service->doneFreelancer($id,$request);
        if ($data) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param $id
     * client say he is approved for done
     */
    public function doneClient($id)
    {
        $data = $this->service->doneClient($id);
        if ($data) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param Request $request
     * freelancer say he isn't approved this task
     */
    public function unApproveFreelancer(Request $request)
    {
        $data = $this->service->unApproveFreelancer($request);
        if ($data) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param Request $request
     * client say he isn't done this task
     */
    public function unApproveClient(Request $request)
    {
        $data = $this->service->unApproveClient($request);
        if ($data) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param Request $request
     * comment in task between client and user
     */
    public function comment(Request $request)
    {
        $data = $this->service->comment($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function show($id)
    {
        $data = $this->service->show($id,true);
        if ($data) {
            return $this->apiResponse(new TaskResource($data), getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function delete($id)
    {
        $data = $this->service->delete($id);
        if (!is_string($data) && $data != false) {
            return $this->deleteResponse(getCustomTranslation('Done'));
        }
        return $this->unKnowError($data);
    }

    public function offerStatus(Request $request,$id=null)
    {
        $data = $this->service->changeStatus($id, 'offer_status');
        if ($data) {
            return $this->updateResponse($data,getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function searchTitle(Request $request)
    {
        $task=[];
        if(!empty($request->searchName) && strlen($request->searchName) > 2) {
            ActiveLog( null, actionType()['ssea'], $request->searchName,Task::class,1);
            $data = $this->service->findBy(new Request(['name' => $request->searchName]), limit: 4);
            $task = $data->pluck('name')->toArray();
            if (count($task) < 4) {
                $data = $this->service->findBy(new Request(['description' => $request->searchName]), limit: 4 - count($task));
                $task = array_merge($task, $data->pluck('name')->toArray());
            }
        }
        if (count($task)) {
            return $this->apiResponse($task,getCustomTranslation('Done'));
        }
        return $this->apiResponse([],getCustomTranslation('Done'));
    }
}
