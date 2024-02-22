<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Requests\FQ\CreateRequest;
use Modules\Setting\Http\Requests\FQ\EditRequest;
use Modules\Setting\Service\FqService;

class FqController extends BasicController
{
    protected $service;

    public function __construct(FqService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:fq-index')->only('index');
        $this->middleware('permission:fq-create')->only('store');
        $this->middleware('permission:fq-edit')->only('update');
        $this->middleware('permission:fq-change-status')->only('changeStatus');
        $this->middleware('permission:fq-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('setting::fq.index'), compact('datas'));
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
