<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Status\CreateRequest;
use Modules\CoreData\Http\Requests\Status\EditRequest;
use Modules\CoreData\Service\StatusService;

class StatusController extends BasicController
{
    protected $service;

    public function __construct(StatusService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:status-index')->only('index');
        $this->middleware('permission:status-create')->only('store');
        $this->middleware('permission:status-edit')->only('update');
        $this->middleware('permission:status-change-status')->only('changeStatus');
        $this->middleware('permission:status-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'status');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::status.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->service->store($request));
    }
    public function edit($id)
    {
        $data = $this->service->show($id);
        ActiveLog($data, actionType()['va'], 'status');
        return view(checkView('coredata::status.edit'),compact('data'));
    }
    public function update(EditRequest $request, $id)
    {
        $data= $this->service->update($request,$id);
        if($data)
        {
            return redirect(route('status.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('status.edit'))->with(getCustomTranslation('problem'));
    }

}
