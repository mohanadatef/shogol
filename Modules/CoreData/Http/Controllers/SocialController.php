<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Social\CreateRequest;
use Modules\CoreData\Http\Requests\Social\EditRequest;
use Modules\CoreData\Service\SocialService;

class SocialController extends BasicController
{
    protected $service;

    public function __construct(SocialService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:social-index')->only('index');
        $this->middleware('permission:social-create')->only('store');
        $this->middleware('permission:social-edit')->only('update');
        $this->middleware('permission:social-change-status')->only('changeStatus');
        $this->middleware('permission:social-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'social');
        $datas = $this->service->findBy($request,true , $this->perPage());
        return view(checkView('coredata::social.index'), compact('datas'));
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
