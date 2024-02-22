<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Acl\Service\UserService;
use Modules\Task\Service\AdService;
use Modules\Task\Service\TaskService;
use Modules\Setting\Repositories\ReportRepository;

class ReportService extends BasicService
{
    protected $adService, $taskService, $userService, $repository;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(AdService $adService, TaskService $taskService, UserService $userService, ReportRepository $repository)
    {
        $this->adService = $adService;
        $this->taskService = $taskService;
        $this->userService = $userService;
        $this->repo = $repository;
    }

    public function store(Request $request)
    {
        $checkModel = $this->{$request->model . 'Service'} ?? null;
        if ($checkModel) {
            $data = $this->{$request->model . 'Service'}->show($request->id);
            if($data){
                $data->report()->create(['user_id' => user()->id,'comment'=>$request->comment]);
                ActiveLog($data, actionType()['ca'], $request->model);
            }
        }
        return true;
    }

    public function findBy(Request $request, $pagination = false, $perPage = 10)
    {
        ActiveLog(null, actionType()['va'],'Report');
        return $this->repo->findBy($request, [], $pagination, $perPage);
    }

    public function changeStatus($id,$key)
    {
        $data=$this->repo->updateValue($id,$key);
        if($data)
        {
            $data = $this->repo->save(new Request(['solved_by'=>user()->id]),$id);
            ActiveLog($data, actionType()['sa'], '');
            return $data;
        }
        return false;
    }
}
