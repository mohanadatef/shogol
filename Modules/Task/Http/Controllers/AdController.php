<?php

namespace Modules\Task\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Task\Http\Requests\Ad\rejectApproveRequest;
use Modules\Task\Service\AdService;

class AdController extends BasicController
{
    protected $service;

    public function __construct(AdService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:ad-index')->only('index');
        $this->middleware('permission:ad-show')->only('show');
        $this->middleware('permission:ad-delete')->only('delete');
        $this->middleware('permission:ad-cansel')->only('cansel');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null, actionType()['va'], 'ad');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('task::ad.index'), compact('datas'));
    }

    public function cansel(rejectApproveRequest $request)
    {
        return $this->service->cansel($request);
    }

    public function show($id)
    {
        $data= $this->service->show($id);
        return view(checkView('task::ad.show'), compact('data'));
    }
}
