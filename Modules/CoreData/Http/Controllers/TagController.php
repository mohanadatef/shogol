<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Tag\CreateRequest;
use Modules\CoreData\Http\Requests\Tag\EditRequest;
use Modules\CoreData\Service\TagService;

class TagController extends BasicController
{
    protected $service;

    public function __construct(TagService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:tag-index')->only('index');
        $this->middleware('permission:tag-create')->only('store');
        $this->middleware('permission:tag-edit')->only('update');
        $this->middleware('permission:tag-change-status')->only('changeStatus');
        $this->middleware('permission:tag-delete')->only('delete');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'tag');
        $datas = $this->service->findBy($request,true , $this->perPage());
        $category=$this->service->getListCategory($request);
        return view(checkView('coredata::tag.index'), compact('datas','category'));
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
