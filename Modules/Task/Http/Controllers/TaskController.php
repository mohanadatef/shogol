<?php

namespace Modules\Task\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Task\Http\Requests\Task\rejectApproveRequest;
use Modules\Task\Service\TaskService;

/**
 * @extends BasicController
 * controller task about web function
 */
class TaskController extends BasicController
{
    protected $service;
    /**
     * @param TaskService $Service
     * @required login for all function
     * @note admin middleware
     */
    public function __construct(TaskService $Service)
    {
        $this->middleware(['auth','admin']);
        $this->middleware('permission:task-index')->only('index');
        $this->middleware('permission:task-show')->only('show');
        $this->middleware('permission:task-edit')->only('update');
        $this->middleware('permission:task-delete')->only('delete');
       $this->middleware('permission:task-cansel')->only('cansel');
        $this->middleware('permission:task-approve')->only(['acceptApprove','rejectApprove']);
        $this->service = $Service;
    }

    /**
     * @param Request $request
     * get all task to manage it
     */
    public function index(Request $request)
    {
        ActiveLog(null, actionType()['va'], 'task');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('task::task.index'), compact('datas'));
    }
    /**
     * @param $id
     * approve task by admin
     */
    public function acceptApprove($id)
    {
        return $this->service->approve($id);
    }

    /**
     * @param rejectApproveRequest $request
     * reject task by admin
     */
    public function rejectApprove(rejectApproveRequest $request)
    {
        return $this->service->rejectApprove($request);
    }

    /**
     * @param rejectApproveRequest $request
     * @return bool|string
     * cansel task by admin
     */
    public function cansel(rejectApproveRequest $request)
    {
        return $this->service->cansel($request);
    }

    /**
     * @param $id
     * get one task
     */
    public function show($id)
    {
        $data = $this->service->show($id);
        $category = $this->service->getCategoryList();
        return view(checkView('task::task.show'), compact('data','category'));
    }

    public function update(Request $request,$id)
    {
        $this->service->update($request,$id);
        return redirect(route('task.index'))->with(getCustomTranslation('Done'));
    }
}
