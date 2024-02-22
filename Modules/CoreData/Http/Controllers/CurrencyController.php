<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Currency\CreateRequest;
use Modules\CoreData\Http\Requests\Currency\EditRequest;
use Modules\CoreData\Service\CurrencyService;

class CurrencyController extends BasicController
{
    protected $service;

    public function __construct(CurrencyService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:currency-index')->only('index');
        $this->middleware('permission:currency-create')->only('store');
        $this->middleware('permission:currency-edit')->only('update');
        $this->middleware('permission:currency-change-status')->only('changeStatus');
        $this->middleware('permission:currency-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'currency');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::currency.index'), compact('datas'));
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
