<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Requests\Cancellation\CreateRequest;
use Modules\Setting\Http\Requests\Cancellation\EditRequest;
use Modules\Setting\Service\CancellationService;

class CancellationController extends BasicController
{
    protected $service;

    public function __construct(CancellationService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:cancellation-index')->only('index');
        $this->middleware('permission:cancellation-create')->only('store');
        $this->middleware('permission:cancellation-edit')->only('update');
        $this->middleware('permission:cancellation-change-status')->only('changeStatus');
        $this->middleware('permission:cancellation-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'cancellation');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('setting::cancellation.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->service->store($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->service->update($request, $id));
    }

    public function parent(Request $request)
    {
        return $this->service->parent($request);
    }

}
