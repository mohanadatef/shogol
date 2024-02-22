<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Area\CreateRequest;
use Modules\CoreData\Http\Requests\Area\EditRequest;
use Modules\CoreData\Service\AreaService;

class AreaController extends BasicController
{
    protected $service;

    public function __construct(AreaService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:area-index')->only('index');
        $this->middleware('permission:area-create')->only('store');
        $this->middleware('permission:area-edit')->only('update');
        $this->middleware('permission:area-change-status')->only('changeStatus');
        $this->middleware('permission:area-delete')->only('delete');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'area');
        $datas = $this->service->findBy($request,true , $this->perPage());
        $country=$this->service->getListCountry($request);
        $request->merge(['withoutResource'=>true]);
        return view(checkView('coredata::area.index'), compact('datas','country'));
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
