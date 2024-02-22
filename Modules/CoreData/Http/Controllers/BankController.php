<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Bank\CreateRequest;
use Modules\CoreData\Http\Requests\Bank\EditRequest;
use Modules\CoreData\Service\BankService;

class BankController extends BasicController
{
    protected $service;

    public function __construct(BankService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:bank-index')->only('index');
        $this->middleware('permission:bank-create')->only('store');
        $this->middleware('permission:bank-edit')->only('update');
        $this->middleware('permission:bank-change-status')->only('changeStatus');
        $this->middleware('permission:bank-delete')->only('delete');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'bank');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::bank.index'), compact('datas'));
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
