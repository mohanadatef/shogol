<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\JobName\CreateRequest;
use Modules\CoreData\Http\Requests\JobName\EditRequest;
use Modules\CoreData\Service\JobNameService;

class JobNameController extends BasicController
{
    protected $service;

    public function __construct(JobNameService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:job-name-index')->only('index');
        $this->middleware('permission:job-name-create')->only('store');
        $this->middleware('permission:job-name-edit')->only('update');
        $this->middleware('permission:job-name-change-status')->only('changeStatus');
        $this->middleware('permission:job-name-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'job_name');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::job_name.index'), compact('datas'));
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
