<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Acl\Http\Requests\User\CreateRequest;
use Modules\Acl\Http\Requests\User\rejectApproveRequest;
use Modules\Acl\Service\UserService;
use Modules\Basic\Http\Controllers\BasicController;
/**
 * @extends BasicController
 * controller user about web function
 */
class UserController extends BasicController
{
    protected $service;
    /**
     * @extends BasicController
     * controller user about web function
     * @required user login
     */
    public function __construct(UserService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:user-index')->only('index');
        $this->middleware('permission:user-create')->only('store');
        $this->middleware('permission:user-change-status')->only('changeStatus');
        $this->middleware('permission:user-delete')->only('delete');
        $this->middleware('permission:user-verified')->only('verified');
        $this->middleware('permission:user-approve')->only(['acceptApprove','rejectApprove']);
        $this->service = $Service;
    }

    /**
     * @param Request $request
     * @return View
     * get all user to manage it
     */
    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'user');
        $datas = $this->service->findBy($request,[],'',['*'],true,$this->perPage());
        return view(checkView('acl::user.index'), compact('datas'));
    }

    /**
     * @param $id
     * approve account user for login in system
     */
    public function acceptApprove($id)
    {
       return $this->service->changeStatus($id,'approve');
    }

    /**
     * @param $request
     * un approve account user for login in system
     */
    public function rejectApprove(rejectApproveRequest $request)
    {
        return $this->service->rejectApprove($request);
    }

    /**
     * @param $id => id user we need to verified email
     * verified email by admin manuel
     */
    public function verified($id)
    {
        return $this->service->verified(new Request(['id'=>$id]));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->service->store($request));
    }
}
