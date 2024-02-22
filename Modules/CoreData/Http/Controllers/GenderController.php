<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Gender\CreateRequest;
use Modules\CoreData\Http\Requests\Gender\EditRequest;
use Modules\CoreData\Service\GenderService;

class GenderController extends BasicController
{
    protected $service;

    public function __construct(GenderService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:gender-index')->only('index');
        $this->middleware('permission:gender-create')->only('store');
        $this->middleware('permission:gender-edit')->only('update');
        $this->middleware('permission:gender-change-status')->only('changeStatus');
        $this->middleware('permission:gender-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'gender');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::gender.index'), compact('datas'));
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
