<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Acl\Http\Requests\Permission\EditRequest;
use Modules\Acl\Service\PermissionService;

class PermissionController extends BasicController
{
    protected $service;

    public function __construct(PermissionService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-index')->only('index');
        $this->middleware('permission:permission-edit')->only('update');
        $this->middleware('permission:permission-delete')->only('delete');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,'',[],[]   ,true,$this->perPage());
        ActiveLog([], actionType()['va'], 'Permission');
        return view(checkView('acl::permission.index'), compact('datas'));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->service->update($request, $id));
    }

}
