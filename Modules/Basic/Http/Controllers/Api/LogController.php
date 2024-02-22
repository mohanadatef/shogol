<?php

namespace Modules\Basic\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Basic\Http\Resources\Log\logListResource;
use Modules\Basic\Service\LogService;
use Modules\Task\Entities\Ad;
use Modules\Task\Entities\Task;

class LogController extends BasicController
{
    private $service;

    public function __construct(LogService $Service)
    {
        $this->service = $Service;
    }

    public function store(Request $request)
    {
        $this->service->store($request);
        return $this->createResponse([], getCustomTranslation('Done'));
    }

    public function getSaveSearch(Request $request)
    {
        if(user())
        {
            $data = [];
            if(!empty($request->model))
            {
                $affected = null;
                if($request->model == 'ad')
                {
                    $affected = Ad::class;
                }elseif($request->model == 'task')
                {
                    $affected = Task::class;
                }elseif($request->model == 'user')
                {
                    $affected = User::class;
                }
                $data = $this->service->findBy(new Request(['done_by' => user()->id, 'action' => actionType()['ssea'], 'affected_type' => $affected, 'search' => 1]),
                    limit: 4, latest: 'latest');
            }
            if(count($data))
            {
                return $this->apiResponse(logListResource::collection($data), getCustomTranslation('Done'));
            }
        }
        return $this->apiResponse([], getCustomTranslation('Done'));
    }

    public function deleteSaveSearch(Request $request)
    {
        if(!empty($request->model))
        {
            $affected = null;
            if($request->model == 'ad')
            {
                $affected = Ad::class;
            }elseif($request->model == 'task')
            {
                $affected = Task::class;
            }elseif($request->model == 'user')
            {
                $affected = User::class;
            }
            if(isset($request->id) && !empty($request->id) && $request->id != 0)
            {
                $data = $this->service->show($request->id);
                if($data)
                {
                    $this->service->update(new Request(['search' => 0]), $request->id);
                }
            }elseif(isset($request->id) && !empty($request->id) && $request->id == 0)
            {
                $data = $this->service->findBy(new Request(['done_by' => user()->id, 'action' => actionType()['ssea'], 'affected_type' => $affected, 'search' => 1]));
                foreach($data as $d)
                {
                    $this->service->update(new Request(['search' => 0]), $d->id);
                }
            }
            return $this->apiResponse([], getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }
}
