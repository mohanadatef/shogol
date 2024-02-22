<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\State\CreateRequest;
use Modules\CoreData\Http\Requests\State\EditRequest;
use Modules\CoreData\Service\StateService;

class StateController extends BasicController
{
    protected $service;

    public function __construct(StateService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:state-index')->only('index');
        $this->middleware('permission:state-create')->only('store');
        $this->middleware('permission:state-edit')->only('update');
        $this->middleware('permission:state-change-status')->only('changeStatus');
        $this->middleware('permission:state-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'state');
        $datas = $this->service->findBy($request,true , $this->perPage());
        $country=$this->service->getListCountry($request);
        return view(checkView('coredata::state.index'), compact('datas','country'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->service->store($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->service->update($request, $id));
    }
}
