<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Nationality\CreateRequest;
use Modules\CoreData\Http\Requests\Nationality\EditRequest;
use Modules\CoreData\Service\NationalityService;

class NationalityController extends BasicController
{
    protected $service;

    public function __construct(NationalityService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:nationality-index')->only('index');
        $this->middleware('permission:nationality-create')->only('store');
        $this->middleware('permission:nationality-edit')->only('update');
        $this->middleware('permission:nationality-change-status')->only('changeStatus');
        $this->middleware('permission:nationality-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'nationality');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::nationality.index'), compact('datas'));
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
