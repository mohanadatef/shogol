<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Country\CreateRequest;
use Modules\CoreData\Http\Requests\Country\EditRequest;
use Modules\CoreData\Service\CountryService;

class CountryController extends BasicController
{
    protected $service;

    public function __construct(CountryService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:country-index')->only('index');
        $this->middleware('permission:country-create')->only('store');
        $this->middleware('permission:country-edit')->only('update');
        $this->middleware('permission:country-change-status')->only('changeStatus');
        $this->middleware('permission:country-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'country');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::country.index'), compact('datas'));
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
