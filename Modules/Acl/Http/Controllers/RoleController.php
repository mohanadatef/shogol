<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Acl\Http\Requests\Role\CreateRequest;
use Modules\Acl\Http\Requests\Role\EditRequest;
use Modules\Acl\Service\RoleService;
use Modules\Basic\Http\Controllers\BasicController;
/**
 * @extends BasicController
 * controller role about web function
 */
class RoleController extends BasicController
{
    protected $service;
    /**
     * @extends BasicController
     * controller role about web function
     */
    public function __construct(RoleService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:role-index')->only('index');
        $this->middleware('permission:role-create')->only(['create','store']);
        $this->middleware('permission:role-edit')->only(['edit','update']);
        $this->middleware('permission:role-delete')->only('delete');
        $this->service = $Service;
    }

    /**
     * @param Request $request
     * @return View
     * get all role to manage it
     */
    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'role');
        $datas = $this->service->findBy($request,'',true,$this->perPage());
        return view(checkView('acl::role.index'), compact('datas'));
    }

    public function create()
    {
        $permission = $this->service->listPermission();
        return view(checkView('acl::role.create'),compact('permission'));
    }

    public function store(CreateRequest $request)
    {
        $data= $this->service->store($request);
        if($data)
        {
            return redirect(route('role.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('role.create'))->with(getCustomTranslation('problem'));
    }

    public function edit($id)
    {
        $data = $this->service->show($id);
        $permission = $this->service->listPermission();
        ActiveLog($data, actionType()['va'], 'role');
        return view(checkView('acl::role.edit'),compact('data','permission'));
    }

    public function update(EditRequest $request, $id)
    {
        $data= $this->service->update($request,$id);
        if($data)
        {
            return redirect(route('role.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('role.edit'))->with(getCustomTranslation('problem'));
    }
}
