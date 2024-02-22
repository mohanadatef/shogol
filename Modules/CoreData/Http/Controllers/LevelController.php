<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Level\CreateRequest;
use Modules\CoreData\Http\Requests\Level\EditRequest;
use Modules\CoreData\Service\LevelService;

class LevelController extends BasicController
{
    protected $service;

    public function __construct(LevelService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:level-index')->only('index');
        $this->middleware('permission:level-create')->only('store');
        $this->middleware('permission:level-edit')->only('update');
        $this->middleware('permission:level-change-status')->only('changeStatus');
        $this->middleware('permission:level-delete')->only('delete');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'level');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::level.index'), compact('datas'));
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
